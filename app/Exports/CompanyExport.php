<?php

namespace App\Exports;

use App\Models\Companies\Company;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompanyExport implements FromArray, WithHeadings
{
    protected $companies;

    public function __construct()
    {
        $this->companies = array();
        foreach (Company::with('user')->with('participants')->get() as $company) {
            # code...
            $item =  array();
            $item['id'] = $company->id;
            $item['name'] = $company->name;
            $item['address'] = $company->address;
            $item['postal_code'] = $company->postal_code;
            $item['city'] = $company->city;
            $item['vat_number'] = $company->vat_number;
            $item['nbr_participants'] = count($company->participants);
            $item['email_connexion'] = $company->user->email;
            //$item['password'] = $company->user->password;
            array_push($this->companies,$item);

        }
        
    }
    
    public function array(): array
    {
        return $this->companies;
    }

    public function headings(): array
    {
        return [
            '#',
            'Dénomination',
            'Adresse',
            'Code Postal',
            'Ville',
            'TVA',
            'Nombre de Participants',
            'Email de Connexion',
            //'Password'
        ];
    }
}
