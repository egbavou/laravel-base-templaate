<?php

namespace App\Exports;

use App\Models\Consummation\Consummation;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ConsummationExport implements FromArray,WithHeadings
{
    protected $consummations;


    public function __construct()
    {
        $consummations = Consummation::with('event')->with('company')->with('product')->with('participant')->get();
        $this->consummations = array();

        foreach ($consummations as $consummation) {

            $item =  array();
            $item['id'] = $consummation->id;
            $item['event'] = $consummation->event->name;
            $item['company'] = $consummation->company->name;
            $item['participant']  = $consummation->participant->person->first_name.' '.$consummation->participant->person->last_name;
            $item['product'] = $consummation->product->name;
            $item['quantity'] = $consummation->quantity;
            $item['payment_type'] = $consummation->payment_type;
            $item['vat_number'] = $consummation->vat_number;
            $item['remark'] = $consummation->remark;
            $item['created_at'] = $consummation->created_at;

            array_push($this->consummations,$item); 
        }
    }

    /**
     * @return array
     */
    public function array(): array
    {
        return   $this->consummations;
    }

    public function headings(): array
    {
        return [
            '#',
            'ÉVÈNEMENT',
            'NOM DE L\'ENTREPRISE',
            'PARTICIPANT',
            'PRODUIT COMMANDÉ',
            'QUANTITÉ',
            'TYPE DE PAIEMENT',
            'N° DE TVA',
            'REMARQUE',
            'DATE DE LA CONSOMMATION',
        ];
    }
}
