<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StructureController extends Controller
{
    /**
     * Afficher la page de gestion des structures
     */
    public function index()
    {
        return view('admin.structures.index');
    }
}
