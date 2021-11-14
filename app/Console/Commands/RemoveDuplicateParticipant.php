<?php

namespace App\Console\Commands;

use App\Models\Participants\Participant;
use App\Models\People\Person;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RemoveDuplicateParticipant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:duplicate:participant';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove duplicate participant';

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
        // $part = DB::table('people')->select('*')->distinct('email')->pluck('id')->toArray();
        // dd($part);
        // Person::whereIn('id', $part)->delete();
        // dd($part);
        foreach (Person::get() as $person) {
            
            if(Person::where('email',$person->email)->get()->count()>1){
                dd($person->email);
            }
        }
    }
}
