<?php

namespace Database\Seeders;

use DateTime;
use App\Models\Events\Event;
use App\Models\People\Person;
use Illuminate\Database\Seeder;
use App\Models\Companies\Company;
use App\Models\Participants\Participant;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $event = Event::where([
            'name'  => 'Course de Karting 3 Septembre 2021',
            'event_date'  =>  '2021-09-03 09:00:00'
        ])->first();
        
        $row = 0;
        if (($handle = fopen(base_path()."/public/participants_per_company-list.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 0, ",",'"')) !== FALSE) {
                //dd($row ,$data);

                if($row!=0){

                    if($row == 859)
                        break;
                    
                    if(!Person::where(['last_name' => $data[7],'first_name' => $data[7]])->first())
                    {
                        // $password = generatePassword();

                        $person = Person::create([
                            'last_name'      => $data[2],
                            'first_name'      => $data[3],
                            'national_registry'  => $data[4],
                            'address'   => $data[5],
                            'postal_code' => $data[6],
                            'city' => $data[7],
                            'email'  => $data[8],
                            'phone' => $data[9]
                        ]);

                        $company = Company::where('name',$data[1])->first();

                        Participant::create([
                            'company_id'    =>  $company->id,
                            'event_id'      => $event->id,
                            'person_id'      =>  $person->id,
                            'about_covid'   =>  $data[10],
                            'term_and_condition' =>  $data[11]===1 ? true : false,
                            'created_at'   =>  DateTime::createFromFormat("d/m/y H:i", $data[12])->format('Y-m-d H:i'),
                            'confirm'      =>  $data[13] ? DateTime::createFromFormat("d/m/y H:i", $data[13])->format('Y-m-d H:i') : null,
                            'refused'      =>  $data[14] ? DateTime::createFromFormat("d/m/y H:i", $data[14])->format('Y-m-d H:i') : null,
                            'present'      => $data[15]  ? DateTime::createFromFormat("d/m/y H:i", $data[15])->format('Y-m-d H:i') : null
                        ]);

                        

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
