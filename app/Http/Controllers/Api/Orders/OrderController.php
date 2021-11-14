<?php

namespace App\Http\Controllers\Api\Orders;

use App\Models\Events\Event;
use App\Models\Companies\Company;
use App\Http\Controllers\Controller;
use App\Models\Orders\Order;
use Illuminate\Support\Facades\Request;

class OrderController extends Controller
{
    //

    public function searchCompany(Request $request)
    {

        Request::validate([
            'email' => ['required','exists:companies,email']
        ]);
        
        return response()->json([
            "status"  => true,
            "company" => Company::where('email',Request::get('email'))->first()
        ],200); 

    }

    public function checkTableQuantity(Request $request)
    {
        # code...
        Request::validate([
            'quantity' => ['required','integer'],
            'event_id' => ['required','exists:events,id'],
            'order_id' => ['nullable','exists:orders,id']

        ]);

        $event = Event::where('id',Request::get('event_id'))->first();

        $number_of_tables = 0;

        foreach (Order::where('event_id',$event->id)->get() as $order)
        {
            if(Request::get('order_id') != $order->id)
            {
                foreach ($order->order_has_event_products as $order_has_event_product)
                {
                    if(!is_bool(strpos($order_has_event_product->event_has_product->name,'Table'))){
                        $number_of_tables = $number_of_tables + $order_has_event_product->quantity;
                    }
                }
            }
            
        }

        if($event->number_of_tables-($number_of_tables+Request::get('quantity'))>0)
        {
            return response()->json([
                "status"  => true,
            ],200);

        }else{
            return response()->json([
                "status"   => false,
                "quantity" => $event->number_of_tables-($number_of_tables),
            ],200);
        }
    }
}
