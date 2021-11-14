<?php

namespace App\Http\Controllers\Api\Bars;

use App\Rules\BEVatNumber;
use App\Models\Orders\Order;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use App\Models\Participants\Participant;
use App\Models\Consummation\Consummation;
use App\Models\Orders\OrderHasEventProduct;

class BarsController extends Controller
{
    public function scanQr()
    {
        Request::validate([
            'code' => ['required','exists:participants,id']
        ]);

        $participant = Participant::with('event')->with('person')->with('company')->with('participant_has_event_droit')->where('id',Request::get('code'))->first();

        $used = false;
        
        if ($participant->present ===null && $participant->confirm && $participant->event->status==='In Progress') {
            $used = true;
        }

        $orders = Order::with('order_has_event_products')->where([
            'event_id'  => $participant->event->id,
            'company_id'    => $participant->company->id    
        ])->get();

        $event_has_products = [];

        foreach ($participant->event->event_has_products as $event_has_product) {
            
            if(!str_contains($event_has_product->name,'Table'))
                array_push($event_has_products,$event_has_product);
        }

        $purchase_order_products = [];

        foreach ($event_has_products as $event_has_product) {
            
            $purchase_order_product = [];
            $purchase_order_product['event_has_product'] = $event_has_product;
            $purchase_order_product['ordered'] = OrderHasEventProduct::where('event_has_product_id',$event_has_product->id)->whereIn('order_id',$orders->pluck('id')->toArray())->sum('quantity');

            $consummations = Consummation::where([
                'event_has_product_id' => $event_has_product->id,
                'event_id'  => $participant->event->id,
                'company_id'    => $participant->company->id,
                'cancel'        => 0
            ])->with('participant')->get();

            $consumed = 0;

            foreach ($consummations as $consummation) {
               
                if($consummation->participant->participant_has_event_droit){
                    $consumed = $consumed + $consummation->quantity;
                }
            }

            $purchase_order_product['consumed'] = $consumed;
            array_push($purchase_order_products, $purchase_order_product);
        }

        return response()->json([
            "valid" => $used,
            "status" =>  $participant->event->status,
            "participant" => $participant,
            "event_has_products" => $event_has_products,
            "purchase_order_products" => $purchase_order_products,
            "old_consummations" => Consummation::whereEventId($participant->event->id)->with('product')->get(),
        ],200);

    }

    public function order()
    {
        Request::validate([
            'participant_id' => ['required','exists:participants,id'],
            'event_id' => ['required','exists:events,id'],
            'company_id' => ['required','exists:companies,id'],
            'orders.*.id' => ['required','exists:event_has_products,id'],
            'orders.*.quantity' => ['required'],
            'payment_type' => ['nullable',Rule::in(['Paiement facture','Cash','Bancontact','Visa'])],
            'remark'   => ['nullable','string'],
            'vat_number'  => ['nullable','string','regex:/\BE0\d{3}[.]\d{3}[.]\d{3}$/','min:12','max:15',new BEVatNumber],
        ]);

        $data = Request::all();
        foreach ($data['orders'] as $order) {
            Consummation::create([
                'participant_id' => $data['participant_id'],
                'event_id' => $data['event_id'],
                'company_id' => $data['company_id'],
                'event_has_product_id' => $order['id'],
                'quantity' => $order['quantity'],
                'payment_type'  => $data['payment_type'],
                'remark'    => $data['remark'],
                'vat_number' => $data['vat_number']
            ]);
        }

        $participant = Participant::where('id',Request::get('participant_id'))->first();

        $phone = str_replace('+','',$participant->person->phone);

        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIyMjA0OCIsImlhdCI6MTYyNTIxOTc2M30.Xa1mIztZT8o5cpEkFn8I0_VPRzOX4hk_irLSGLBDl0s";

        $message = "Confirmation de votre commande boisson: ";

        foreach (Request::get('orders') as $order) {
            $message = $message.$order['quantity'].' '.$order['name'];
        }

        $message = $message.'.';

        $url = "https://api.smsfactor.com/send?text=".$message."&to=".$phone."&token=".$token."&sender=Charnoy";

        Curl::to($url)->get();

        return response()->json([
            'message' => "Operation effectué"
        ],200);
    }
}
