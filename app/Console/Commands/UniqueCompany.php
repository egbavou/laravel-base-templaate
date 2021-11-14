<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Companies\Company;

class UniqueCompany extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unique:company';

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
        $companies = Company::where('id','!=',1)->get();

        foreach ($companies as $company) {
            //print_r($company->name);
            if (Company::where('email',$company->email)->get()->count()>1) {
                print_r($company->name);
            }
        }
    }
}
