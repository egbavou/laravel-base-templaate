<?php

namespace App\Mail\EntryConditions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EntryCondition extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@facilesolution.com','CHARNOY')
            ->subject('Condition d\'entrée à l\'évènement du 03/09/2021')
            ->markdown('email.entry_conditions.entry_condition');
    }
}
