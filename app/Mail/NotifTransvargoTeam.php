<?php

namespace App\Mail;

use App\Expedition;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifTransvargoTeam extends Mailable
{
    use Queueable, SerializesModels;
    public $expedition;

    /**
     * Create a new message instance.
     *
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
        return $this->from (env('MAIL_USERNAME'), config('app.name'))
            ->view('email.notif-team-transvargo', ["expedition" => $this->expedition]);
    }
}
