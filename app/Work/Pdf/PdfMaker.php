<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 02/11/2017
 * Time: 10:05
 */

namespace App\Work\Pdf;

use App\Expedition;
use Barryvdh\DomPDF\Facade as PDF;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

trait PdfMaker
{
    protected function getSingle(string $reference, $admin = false)
    {
        $expeditions = Expedition::with('client','chargement','typeCamion')
            ->where('reference', $reference)
            //->whereNotIn('statut',[Statut::TYPE_EXPEDITION.Statut::ETAT_LIVREE.Statut::AUTRE_NON_NULL])
            ->orderBy('datechargement');

        if(!$admin){
            $expeditions = $expeditions->where('client_id',Auth::id());
        }

        return $expeditions->get();
    }

    protected function getAllInvoice()
    {
        return Expedition::with('client','chargement','typeCamion')
            ->where('client_id',Auth::id())
            //->whereNotIn('statut',[Statut::TYPE_EXPEDITION.Statut::ETAT_LIVREE.Statut::AUTRE_NON_NULL])
            ->orderBy('datechargement')
            ->get();
    }

    public function showFacturePDF($reference = null)
    {
        $invoices = $reference ? $this->getSingle($reference, (Auth::user()->staff != null)) : $this->getAllInvoice();
        $invoices = PDF::loadView('invoices.factures',compact("invoices"))->setPaper('a4','portrait');
        return $invoices->stream("Facture $reference.pdf");
    }

    public function showBonLivraisonPDF($reference)
    {
        $invoices = $reference ? $this->getSingle($reference, (Auth::user()->staff != null)) : $this->getAllInvoice();

        //$this->generateTCPDF($invoices);

        $invoices = PDF::loadView('invoices.livraison',compact("invoices"))->setPaper('a4','portrait');
        return $invoices->stream("Bon Livraison $reference.pdf");
    }

    private function generateTCPDF($invoices)
    {
        $view = \Illuminate\Support\Facades\View::make('invoices.livraison',compact("invoices"));
        $html = $view->render();

        $pdf = new TCPDF();
        $pdf::SetTitle('Hello World');
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::Output('hello_world.pdf');
    }
}