<?php

namespace App\Mail\Participants;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ParticipantQrCode extends Mailable
{
    use Queueable, SerializesModels;

    public $qr_code;
    public $participant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($qr_code,$participant)
    {
        $this->qr_code = $qr_code;
        $this->participant = $participant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@facilesolution.com','CHARNOY')
            ->subject('Qr code de confirmation pour l\'événement '.$this->participant->event->name)
            ->markdown('email.participants.qr_code');
    }
}
