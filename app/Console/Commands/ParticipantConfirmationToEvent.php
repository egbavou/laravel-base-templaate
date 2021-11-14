<?php

namespace App\Console\Commands;

use DateTime;
use Carbon\Carbon;
use BaconQrCode\Writer;
use App\Models\Events\Event;
use App\Models\Events\Ticket;
use App\Models\People\Person;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use BaconQrCode\Renderer\ImageRenderer;
use Illuminate\Support\Facades\Storage;
use App\Models\Participants\Participant;
use App\Mail\Participants\ParticipantQrCode;
use App\Mail\Participants\InvitationResponse;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;

class ParticipantConfirmationToEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'confirmation:to:event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $person = Person::where([
            'last_name' => 'ASSET',
            'first_name' => 'Damien'
        ])->first();

        $participant = Participant::where('person_id',$person->id)->first();

        $date = new DateTime();

        $participant->update([
            'confirm'   => $date->format('Y-m-d H:i:s'),
            'refused'   => null
        ]);

        $invitation_response = new InvitationResponse($participant,true);
        
        Mail::to($participant->company->email)->send($invitation_response);

        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new ImagickImageBackEnd()
        );
        $writer = new Writer($renderer);  

        $qr_image = base64_encode($writer->writeString($participant->id));

        Storage::disk('s3')->put('qr_code_'.$participant->id.'.png', base64_decode($qr_image));

        $qr_code = Storage::temporaryUrl('qr_code_'.$participant->id.'.png',Carbon::now()->addDays(5));

        if(Ticket::where(['name' => 'qr_code_'.$participant->id,])->first())
        {
            $code =  Ticket::where(['name' => 'qr_code_'.$participant->id,])->first()->code;
        }else{
            $code =  $this->createCode();
            Ticket::create([
                'name' => 'qr_code_'.$participant->id,
                'code'  => $code
            ]);
        }
            
        $participant_qr_code = new ParticipantQrCode(
            $code,
            $participant
        );

        if($participant->person->email)
            Mail::to($person->email)
                ->bcc('egbavou32@gmail.com')
                ->send($participant_qr_code);

        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIyMjA0OCIsImlhdCI6MTYyNTIxOTc2M30.Xa1mIztZT8o5cpEkFn8I0_VPRzOX4hk_irLSGLBDl0s";
        $message = 'Merci d’avoir confirmé votre participation à l’événement '.$participant->event->name.' organisé par le CHARNOY, '.$participant->event->message." Cliquez sur le lien pour afficher votre ticket d’entrée : ".URL::to('/events/qr-code/'.$code);

        $url = "https://api.smsfactor.com/send?text=".$message."&to=".$person->phone."&token=".$token."&sender=Charnoy";

        Curl::to($url)->get();
        // print_r("Entrer le nom participant: ");
        // fscanf(STDIN, "%s",$last_name); 
        // print_r("Entrer le prénom participant: ");
        // fscanf(STDIN, "%s",$first_name); 
        // print_r("Entrer le nom de l'evenement: ");
        // //readline()
        // fscanf(STDIN, "%s ",$event_name); 

        // dd($event_name);

        // if(Event::where('name',$event_name)->first()){
        //     $event = Event::where('name',$event_name)->first();
        //     $participant = Participant::where([
        //         'first_name'    => $first_name,
        //         'last_name'     => $last_name,
        //         'event_id'      => $event->id
        //     ])->first();

        //     if($participant){
        //         $date = new DateTime();

        //         $participant->update([
        //             'confirm'   => $date->format('Y-m-d H:i:s'),
        //             'refused'   => null
        //         ]);
        //     }else{
        //         print_r("Le participant entré n'existe pas pour cet evenement.");
        //         print_r("\n");
        //     }

        // }else{
        //     print_r("L'evenement entré n'existe pas.");
        //     print_r("\n");

        // }

     
    }
}
