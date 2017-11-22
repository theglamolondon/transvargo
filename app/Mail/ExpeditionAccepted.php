<?php

namespace App\Mail;

use App\Expedition;
use App\Work\Pdf\PdfMaker;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExpeditionAccepted extends Mailable
{
    use Queueable, SerializesModels, PdfMaker;
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
            ->view('email.expedition-accepted', ["expedition" => $this->expedition])
            ->attachData($this->showFacturePDF($this->expedition->reference),
                "Facture ".$this->expedition->facture."pdf", [
                    "mime" => "application/pdf"
                ]);
    }
}
