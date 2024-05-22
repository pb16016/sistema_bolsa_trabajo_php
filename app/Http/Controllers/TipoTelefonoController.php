<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\TipoTelefono;

class TipoTelefonoController extends Controller
{
    public function getAll()
    {
        try {
            $tiposTelefono = TipoTelefono::all();
            return response()->json($tiposTelefono);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ha ocurrido un error al obtener los tipos de teléfono. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById($idTipoTelefono)
    {
        try {
            $tipoTelefono = TipoTelefono::findOrFail($idTipoTelefono);
            return response()->json($tipoTelefono);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Tipo de teléfono no encontrado. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }

}
