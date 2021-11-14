<?php

namespace App\Exports\Sheets;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParticipantPerCompanySheet implements FromArray, WithHeadings, WithTitle
{
    protected $participants;
    protected $company;

    public function __construct($participants,$company)
    {
        //dd($participant->created_at);
        $this->participants = array();
        $this->company = $company;

        foreach ($participants as $participant) {
            # code...
            $item =  array();
            $item['id'] = $participant->id;
            $item['company'] = $participant->company->name;
            $item['first_name'] = $participant->first_name;
            $item['last_name'] = $participant->last_name;
            $item['national_registry'] = $participant->national_registry;
            $item['address'] = $participant->address;
            $item['postal_code'] = $participant->postal_code;
            $item['city'] = $participant->city;
            $item['email'] = $participant->email;
            $item['phone'] = $participant->phone;
            $item['created_at'] = $participant->created_at;
            array_push($this->participants,$item); 
        }
         
    }

    public function array(): array
    {
        return $this->participants;
    }

    public function headings(): array
    {
        return [
            '#',
            'Entreprise',
            'Nom',
            'Prénom',
            'Registre National',
            'Adresse',
            'Code Postal',
            'Ville',
            'Email',
            'Phone',
            'Invité',
            'Confirmé',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        //dd($this->participants[0]['company']);
        return $this->company->name;
    }

    
}
