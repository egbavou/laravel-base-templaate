<?php

namespace App\Console\Commands;

use App\Models\People\Person;
use Illuminate\Console\Command;

class UpdateNationalRegistry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:national:registry';

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
        $people = Person::get();

        foreach ($people as $person)
        {
            $national_registry_array = str_split($person->national_registry);
            $national_registry = $person->national_registry;

            $new_national_registry = null;

            if(count(str_split($national_registry))===11)
            {
                for ($i=0; $i < count(str_split($national_registry)); $i++)
                { 
                    # code...
                    if($new_national_registry){
                        if(count(str_split($new_national_registry))===2 || count(str_split($new_national_registry))===5 || count(str_split($new_national_registry))===12)
                        {
                            $new_national_registry = $new_national_registry.'.'.$national_registry_array[$i];
                        }else{
                            if(count(str_split($new_national_registry))===8){
                                $new_national_registry = $new_national_registry.'-'.$national_registry_array[$i];
                            }else{
                                $new_national_registry = $new_national_registry.$national_registry_array[$i];
                            }
                        }
                    }else{
                        $new_national_registry = $national_registry_array[$i];

                    }
                    
                }

                Person::where('id',$person->id)->update([
                    'national_registry' => $new_national_registry
                ]);
            }
        }

    }
}
