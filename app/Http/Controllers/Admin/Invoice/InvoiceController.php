<?php

namespace App\Http\Controllers\Admin\Invoice;

use App\Client;
use App\Work\Pdf\PdfMaker;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    use PdfMaker;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showInvoiceBoard($id)
    {
        $client = Client::find($id);

        return view('staff.invoice.board',compact("client"));
    }
}