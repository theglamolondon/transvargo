<?php

namespace App\Http\Controllers\Carrier;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class TransporteurController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','transporteur']);
    }

    public function showDashboard()
    {
        return view('carrier.dashboard');
    }

    public function showOffersOnMap()
    {
        return view('carrier.offers');
    }
}
