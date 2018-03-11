<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 01/11/2017
 * Time: 18:33
 */

namespace App\Mail;


use App\Expedition;
use App\Work\Pdf\PdfMaker;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExpeditionFinishClient extends Mailable
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
        return $this->from(env('MAIL_USERNAME'), config('app.name'))
            ->subject('Expedition #'.$this->expedition->reference." livrée")
            ->view('email.expedition-finish', ["expedition" => $this->expedition]);
            /*
            ->attachData($this->showBonLivraisonPDF($this->expedition->reference),
                "Bon de Livraison ".$this->expedition->bonlivraison."pdf", [
                    "mime" => "application/pdf"
                ]);
            */
    }
}