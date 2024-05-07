<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipios;

class MunicipiosController extends Controller
{
    public function getAll()
    {
        // Obtener todos los municipios
        $municipios = Municipios::all();
        return view('municipios', compact('municipios'));
    }
}
