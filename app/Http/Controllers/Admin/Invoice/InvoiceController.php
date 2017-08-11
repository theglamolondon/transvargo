<?php

namespace App\Http\Controllers\Admin\Invoice;

use App\Client;
use App\Expedition;
use App\Services\Statut;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showInvoiceBoard($id)
    {
        $client = Client::find($id);

        return view('staff.invoice.board',compact("client"));
    }

    public function showPDF($reference = null)
    {
        $invoices = $reference ? $this->getSingle($reference) : $this->getInvoice();

        $invoices = PDF::loadView('invoices.factures',compact("invoices"))->setPaper('a4','portrait');

        return $invoices->stream('facture.pdf');
        //return view('invoices.factures');
    }

    public function getSingle($reference)
    {
        return Expedition::with('client','chargement','typeCamion')
            ->where('client_id',Auth::id())
            ->where('reference', $reference)
            ->whereNotIn('statut',[Statut::TYPE_EXPEDITION.Statut::ETAT_LIVREE.Statut::AUTRE_NON_NULL])
            ->orderBy('datechargement')
            ->get();
    }

    public function getInvoice()
    {
        return Expedition::with('client','chargement','typeCamion')
            ->where('client_id',Auth::id())
            ->whereNotIn('statut',[Statut::TYPE_EXPEDITION.Statut::ETAT_LIVREE.Statut::AUTRE_NON_NULL])
            ->orderBy('datechargement')
            ->get();
    }
}