<?php

namespace App\Mail\Participants;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationResponse extends Mailable
{
    public $participant;
    public $confirm;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($participant,$confirm)
    {
        //
        $this->participant = $participant;
        $this->confirm = $confirm;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->confirm){
            $subject = 'Confirmation de participation';
        }else{
            $subject = 'Refus de participation';
        }
        return $this->from('noreply@facilesolution.com','CHARNOY')
            ->subject($subject)
            ->markdown('email.participants.invitation_response');
    }
}
