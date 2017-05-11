<?php

namespace App\Mail;

use App\Transporteur;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NouveauTransporteurMailer extends Mailable
{
    use Queueable, SerializesModels;

    public $transporteur;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Transporteur $transporteur)
    {
        $this->transporteur = $transporteur;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('view.name');
    }
}
