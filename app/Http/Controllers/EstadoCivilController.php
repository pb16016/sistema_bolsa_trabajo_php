<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstadoCivil;

class EstadoCivilController extends Controller
{
    public function getAll()
    {
        try {
            $estadoCivil = EstadoCivil::all();
            return response()->json($estadoCivil);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los registros. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function findByCod($codEstadoCivil)
    {
        try {
            $estadoCivil = EstadoCivil::findOrFail($codEstadoCivil);
            return response()->json($estadoCivil);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Estado civil no encontrado. Detalles: ', 'error' => $e->getMessage()], 404);
        }
    }
}
