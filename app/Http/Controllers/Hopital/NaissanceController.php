<?php

namespace App\Http\Controllers\Hopital;

use App\Http\Controllers\Controller;
use App\Models\VoletDeclaration;
use Illuminate\Http\Request;

class NaissanceController extends Controller
{
    public function dashboard()
    {
        $declarations = VoletDeclaration::latest()->paginate(10);
        return view('hopital.dashboard', compact('declarations'));
    }
    public function create()
    {
        return view('hopital.naissances.create');
    }
    public function show($id)
    {
        $declaration = VoletDeclaration::findOrFail($id);
        return view('hopital.naissance.show', compact('declaration'));
    }
}