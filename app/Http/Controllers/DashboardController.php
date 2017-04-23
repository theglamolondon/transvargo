<?php

namespace App\Http\Controllers;

use App\TypeCamion;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showDashboard($id = '000')
    {
        $types = TypeCamion::all();
        return view('site.dashboard',compact("id","types"));
    }
}
