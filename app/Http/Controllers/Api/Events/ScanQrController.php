<?php

namespace App\Http\Controllers\Api\Events;

use DateTime;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Models\Participants\Participant;

class ScanQrController extends Controller
{
    //

    public function scanQr(Request $request)
    {
        Request::validate([
            'code' => ['required','exists:participants,id']
        ]);

        $participant = Participant::with('event')->with('person')->with('company')->where('id',Request::get('code'))->first();

        if($participant->present ===null && $participant->confirm)
        {
            $date = new DateTime();
            //$participant->present = $date->getTimestamp();
            $participant->present = $date->format('Y-m-d H:i:s');
            $participant->save();

            return response()->json([
                "used" => false,
                "participant" => $participant
            ],200); 

        }else{

            return response()->json([
                "used" => true,
                "participant" => $participant
            ],200);
        }

    }

}
