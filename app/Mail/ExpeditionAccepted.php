<?php

namespace App\Mail;

use App\Expedition;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExpeditionAccepted extends Mailable
{
    use Queueable, SerializesModels;
    private $expedition;

    /**
     * Create a new message instance.
     * @param $expedition Expedition
     * @return void
     */
    public function __construct(Expedition $expedition)
    {
        $this->expedition = $expedition;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_USERNAME'))
            ->subject('Expedition #'.$this->expedition->reference." acceptée")
            ->view('email.expedition-accepted');
    }
}
