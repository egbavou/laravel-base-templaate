<?php

namespace App\Http\Controllers\Api\Consummations;

use App\Rules\BEVatNumber;
use App\Http\Controllers\Controller;
use App\Models\Consummation\Consummation;
use Illuminate\Support\Facades\Request;

class ConsummationController extends Controller
{
    //
    public function editVatNumber(Request $request) {
        Request::validate([
            'consummation_id' => ['required','exists:consummations,id'],
            'vat_number'  => ['required','string','regex:/\BE0\d{3}[.]\d{3}[.]\d{3}$/','min:12','max:15',new BEVatNumber],
        ]);

        Consummation::where('id',Request::get('consummation_id'))->update([
            'vat_number' => Request::get('vat_number')
        ]);

        return response()->json([ "success" => true],200);
    }

    
}
