<?php

namespace App\Http\Controllers;

use App\Expedition;
use App\Metier\ClientProcessing;
use App\Services\Statut;
use App\TypeCamion;
use App\Work\Tools;
use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Schema;

class ClientController extends Controller
{
    use ClientProcessing;

    public function __construct()
    {
        $this->middleware(['auth','client']);
    }

    public function showDashboard()
    {
        return view('site.dashboard');
    }

    public function showMyAccount()
    {
        return view('site.myaccount');
    }
}