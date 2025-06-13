<?php

namespace App\Http\Controllers\Hopital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NaissanceController extends Controller
{
    public function dashboard()
    {
        return view('hopital.dashboard');
    }
    public function create()
    {
        return view('hopital.naissances.create');
    }
}