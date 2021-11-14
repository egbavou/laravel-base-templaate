<?php

namespace App\Exports;

use App\Models\People\Person;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PeopleExport implements FromArray,WithHeadings
{
    protected $people;

    public function __construct()
    {

        $people = Person::get();

        $this->people = array();

        foreach ($people as $person) {
            # code...
            $item =  array();
            $item['id'] = $person->id;
            $item['first_name'] = $person->first_name;
            $item['last_name'] = $person->last_name;
            $item['national_registry'] = $person->national_registry;
            $item['address'] = $person->address;
            $item['postal_code'] = $person->postal_code;
            $item['city'] = $person->city;
            $item['email'] = $person->email;
            $item['phone'] = $person->phone;

            array_push($this->people,$item); 
        }
    }
    
    /**
     * @return array
     */
    public function array(): array
    {
        return   $this->people;
    }

    public function headings(): array
    {
        return [
            '#',
            'Nom',
            'Prénom',
            'Registre National',
            'Adresse',
            'Code Postal',
            'Ville',
            'Email',
            'Phone',
        ];
    }
}
