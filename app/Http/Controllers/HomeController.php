<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

       $providerInfo = session()->get('providerInfo');
       

        return view('home', [
            'providerInfo' => $providerInfo,
        ]);
    }
}