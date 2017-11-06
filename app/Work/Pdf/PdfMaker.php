<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 02/11/2017
 * Time: 10:05
 */

namespace App\Work\Pdf;

use App\Expedition;
use App\Services\Statut;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;

trait PdfMaker
{
    protected function getSingle($reference)
    {
        return Expedition::with('client','chargement','typeCamion')
            ->where('client_id',Auth::id())
            ->where('reference', $reference)
            ->whereNotIn('statut',[Statut::TYPE_EXPEDITION.Statut::ETAT_LIVREE.Statut::AUTRE_NON_NULL])
            ->orderBy('datechargement')
            ->get();
    }

    protected function getInvoice()
    {
        return Expedition::with('client','chargement','typeCamion')
            ->where('client_id',Auth::id())
            ->whereNotIn('statut',[Statut::TYPE_EXPEDITION.Statut::ETAT_LIVREE.Statut::AUTRE_NON_NULL])
            ->orderBy('datechargement')
            ->get();
    }

    public function showFacturePDF($reference = null)
    {
        $invoices = $reference ? $this->getSingle($reference) : $this->getInvoice();

        $invoices = PDF::loadView('invoices.factures',compact("invoices"))->setPaper('a4','portrait');

        return $invoices->stream("Facture $reference.pdf");
    }

    public function showBonLivraisonPDF($reference)
    {
        $invoices = $reference ? $this->getSingle($reference) : $this->getInvoice();

        $invoices = PDF::loadView('livraison.factures',compact("invoices"))->setPaper('a4','portrait');

        return $invoices->stream("Bon Livraison $reference.pdf");
    }
}