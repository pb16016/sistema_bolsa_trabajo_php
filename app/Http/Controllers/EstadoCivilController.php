<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\EstadoCivil;

class EstadoCivilController extends Controller
{
    public function getAll()
    {
        try {
            $estadoCivil = EstadoCivil::all();
            return response()->json($estadoCivil);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los registros. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findByCod($codEstadoCivil)
    {
        try {
            $estadoCivil = EstadoCivil::findOrFail($codEstadoCivil);
            return response()->json($estadoCivil);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Estado civil no encontrado. Detalles: ', 'error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }
}
