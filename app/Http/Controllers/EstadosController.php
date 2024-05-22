<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Estados;

class EstadosController extends Controller
{
    public function getAll()
    {
        try {
            $estados = Estados::all();
            return response()->json( $estados);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los estados. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById($idEstado)
    {
        try {
            $estado = Estados::findOrFail($idEstado);
            return response()->json($estado);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Estado no encontrado. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }
}
