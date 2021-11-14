<?php

namespace App\Console\Commands;

use App\Models\Participants\Participant;
use Illuminate\Console\Command;

class ParticipantPhoneUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'participant:phone:update';

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
        foreach (Participant::get() as $participant) {
            # code...
            $phone = str_replace('.','',$participant->phone);
            $phone = str_replace('/','',$phone);
            $phone = str_replace('+','',$phone);
            $phone = str_replace(' ','',$phone);
            $phone = str_replace('00','',$phone);


            $participant->update([
                'phone' =>  $phone
            ]);
        }
    }
}
