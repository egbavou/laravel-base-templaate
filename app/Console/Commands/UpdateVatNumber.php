<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Companies\Company;

class UpdateVatNumber extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:vat:number';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updat company vat number to this format BE0999.999.999';

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

        foreach ($companies as $company)
        {
            # code...
            if($company->vat_number){

                $vat_number = str_replace(' ','',$company->vat_number);
                $vat_number = str_replace('.','',$vat_number);
                $vat_number = str_replace('-','',$vat_number);

                $array_vat_number = str_split($vat_number);

                $new_vat_number = null;

                for ($i=0; $i < count($array_vat_number); $i++)
                { 
                    if($new_vat_number){
                        
                        if(count(str_split($new_vat_number))===6 || count(str_split($new_vat_number))===10){
                            $new_vat_number = $new_vat_number.'.'.$array_vat_number[$i];
                        }else{
                            $new_vat_number = $new_vat_number.$array_vat_number[$i];
                        }
                    }else{
                        $new_vat_number = $array_vat_number[$i];
                    }
                }

                //dd(count(str_split($new_vat_number)));

                if(count(str_split($new_vat_number))===14)
                {
                    $company->update([
                        'vat_number'    => $new_vat_number
                    ]);
                }

            }
        }
    }
}
