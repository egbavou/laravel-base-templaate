<?php

namespace App\Mail\Helps;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HelpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $phone;
    public $email;
    public $question;
    public $company;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$phone,$email,$question,$company)
    {
        // 
        $this->name = $name;
        $this->phone = $phone;
        $this->email  = $email;
        $this->question  = $question;
        $this->company  = $company;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@facilesolution.com','CHARNOY')
            ->subject('Demande d\'aide')
            ->markdown('email.helps.help');
    }
}
