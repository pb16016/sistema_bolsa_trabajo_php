<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paises;

class PaisesController extends Controller
{
    public function getAll()
    {
        $paises = Paises::all();
        return view('paises', compact('paises'));
    }
}
