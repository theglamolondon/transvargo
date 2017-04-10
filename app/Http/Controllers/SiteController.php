<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    //

    public function index(Request $request){
        return view('site.index');
    }

    public function showTermOfUsesPage(Request $request){
        return view('site.terms');
    }

    public function showContactPage(Request $request){
        return view('site.contact');
    }
}