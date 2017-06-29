<?php

namespace App\Http\Controllers\Admin\Invoice;

use App\Client;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
}
