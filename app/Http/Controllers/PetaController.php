<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetaController extends Controller
{
    public function index()
    {
        return view('peta.index'); // Ganti dengan nama view yang sesuai
    }
}
