<?php

namespace App\Console\Commands;

use Ixudra\Curl\Facades\Curl;
use Illuminate\Console\Command;
use App\Models\Companies\Company;
use Illuminate\Support\Facades\Mail;
use App\Models\Participants\Participant;
use App\Mail\EntryConditions\EntryCondition;

class EntryConditionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entry:condition';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Condition of entry to an event';

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
        $entry_condition = new EntryCondition();

        //send entry condition mail to companies 

        $list_companies = Company::where('id','!=',1)->where('email','!=','null')->pluck('email')->toArray();

        //dd($companies);

        //dd(count($list_companies));

        $companies = array();
        print_r('send companies mail');
        print_r("\n");

        for ($i=0; $i < count($list_companies) ; $i++)
        { 
            # code...
            print_r($i."\n");
            if($i>=110){
            
                if(count($companies)===50){
                    array_push($companies,$list_companies[$i]);
                    Mail::to('noreply@facilesolution.com')
                    ->bcc($companies)
                    ->send($entry_condition);
                    $companies = array();
                    sleep(180);
                }else{
                    if($i===(count($list_companies)-1)){
                        array_push($companies,$list_companies[$i]);
                        //dd($companies);
                        Mail::to('noreply@facilesolution.com')
                        ->bcc($companies)
                        ->send($entry_condition);
                        $companies = array();
                        sleep(180);
                    }else{
                        array_push($companies,$list_companies[$i]);
                    }
                }
            }
            
        }

        //send entry condition mail to participants 

        $list_participants = Participant::where('email','!=','null')->pluck('email')->toArray();
        $participants = array();

        print_r('send participant mail');
        print_r("\n");

        for ($i=0; $i < count($list_participants) ; $i++) 
        { 
            # code...
            if($i>=230)
            {
                print_r($i."\n");
                if(count($participants)===10)
                {
                    array_push($participants,$list_participants[$i]);
                    Mail::to('noreply@facilesolution.com')
                        ->bcc($participants)
                        ->send($entry_condition);
                    $participants = array();
                    sleep(90);
                }else{
                    if($i===(count($list_participants)-1)){
                        array_push($participants,$list_participants[$i]);
                        //dd($participants);
                        Mail::to('noreply@facilesolution.com')
                        ->bcc($participants)
                        ->send($entry_condition);
                        $participants = array();
                        sleep(90);
                    }else{
                        array_push($participants,$list_participants[$i]);
                    }
                }
            }
           
        }

        // $sms_message = 'Bonjour à tous, Au vu du nombre de participants à notre événement de ce 3 septembre 2021, nous avons dû inclure le Covid Safe Ticket. Nous vous rappelons donc que l’accès au site du Karting ne pourra se faire qu’à deux conditions : - d’avoir le QR code de l’événement qui vous sera envoyé ce mercredi 01/09/2021. ET - d’avoir votre Covid Safe Ticket qui reprend soit votre vaccination, soit un test PCR, soit un test antigénique fait en pharmacie. Nous sommes désolés pour ces désagréments, Merci l\'équipe, '.config('app.name');
        // print_r('send sms');
        // print_r("\n");
        // foreach (Participant::get() as $participant)
        // {
        //     if($participant->confirm && $participant->phone){
        //         $phone = str_replace('+','',$participant->phone);
        //         explode('32',$phone);
        //         if(count(explode('32',$phone))===1){
        //             $phone = "32".$phone;
        //         }
        //         $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIyMjA0OCIsImlhdCI6MTYyNTIxOTc2M30.Xa1mIztZT8o5cpEkFn8I0_VPRzOX4hk_irLSGLBDl0s";
            
        //         $url = "https://api.smsfactor.com/send?text=".$sms_message."&to=".$phone."&token=".$token."&sender=Charnoy";
        //         //Curl::to($url)->get();
        //         sleep(20);
        //         print_r($participant->id);
        //         print_r("\n");
        //         print_r($phone);
        //         print_r("\n");

        //     }

        // }
    }
}
