<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Models\Companies\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\Companies\CompanyCredential;
use Illuminate\Support\Facades\Hash;

class SaveCompanies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'save:companies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save user for companies';

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
        $row = 0;
        if (($handle = fopen(base_path()."/public/karting.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 0, ",",'"')) !== FALSE) {
                //dd($row,$data);
                if($row == 115)
                  break;
                  
                if($this->validateEmail($data[1])){
                    if(!Company::where('email',$data[1])->first() && !User::where('email',$data[1])->first())
                    {
                    //dd($data);
                        $password = generatePassword();

                        $company = Company::create([
                        'name' => $data[0],
                        'email'  => $data[1]
                        ]);

                        User::create([
                            'company_id'    =>  $company->id,
                            'email'         =>  $data[1],
                            'password'      =>  Hash::make($password)
                        ]);

                        $company_credential = new CompanyCredential(
                            $data[0],
                            $data[1],
                            $password
                        );
                
                        Mail::to($data[1])
                            ->cc($data[1])
                            ->send($company_credential);
                    }
                }
                
                $row++;
            }
            fclose($handle);
        }
    }

    public function validateEmail($email) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        else {
            return false;
        }
    }
}
