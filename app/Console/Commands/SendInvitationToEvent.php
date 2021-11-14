<?php

namespace App\Console\Commands;

use App\Models\Events\Event;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Participants\Participant;
use App\Mail\Participants\ParticipantInvitation;
use Illuminate\Support\Facades\Log;

class SendInvitationToEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:invitation';

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
        $active_event = null;
        foreach (Event::with('event_has_products')->get() as $event)
        {
            # code...
            if($event->status==='In Progress'){
                $active_event = $event;
            }
        }

        if($active_event)
        {
            Log::debug('Start send Invitation');

            $participants = Participant::where('event_id',$active_event->id)->get();

            foreach ($participants as $participant)
            {
                # code...
                if(!$participant->confirm){

                    Log::debug('Participant: '.$participant->person->first_name.' '.$participant->person->last_name);
    
                    $phone = str_replace('+','',$participant->person->phone);
    
                    $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIyMjA0OCIsImlhdCI6MTYyNTIxOTc2M30.Xa1mIztZT8o5cpEkFn8I0_VPRzOX4hk_irLSGLBDl0s";
                    $message = "Vous venez de recevoir une invitation de l'entreprise "
                        .$participant->company->name."  pour participer à  un évènement organisé par le CHARNOY: ".$participant->event->name.' '.$participant->event->message
                        ." Cliquez sur le lien ci dessous  pour confirmer votre participation:  ".route('participants.show.confirm.form',$participant->id)
                        ." ou cliquez sur le lien ci dessous  pour refuser de participer à l'évènement:  ".route('participants.show.refused.form',$participant->id).".";

                    $url = "https://api.smsfactor.com/send?text=".$message."&to=".$phone."&token=".$token."&sender=Charnoy";
            
                    Curl::to($url)->get();
            
                    $participant_invitation = new ParticipantInvitation($participant);
            
                    if($participant->person->email)
                        Mail::to($participant->person->email)->send($participant_invitation);
    
                }
            }
            Log::debug('End send Invitation');

        }
        
        
    }
}
