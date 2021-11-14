<?php

namespace App\Mail\Orders;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order,$password)
    {
        //
        $this->order = $order;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@facilesolution.com','CHARNOY')
            ->subject('Notification de création de commande sur Charnoy')
            ->markdown('email.orders.creation_notification');
    }
}
