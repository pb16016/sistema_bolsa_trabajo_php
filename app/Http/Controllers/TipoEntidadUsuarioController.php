<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoEntidadUsuario;

class TipoEntidadUsuarioController extends Controller
{
    public function getAll()
    {
        try {
            $tiposEntidad = TipoEntidadUsuario::all();
            return response()->json($tiposEntidad);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ha ocurrido un error al obtener los tipos de entidad. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function findById($idTipoEntidad)
    {
        try {
            $tipoEntidad = TipoEntidadUsuario::findOrFail($idTipoEntidad);
            return response()->json($tipoEntidad);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Tipo entidad de usuario no encontrado. Detalles: ' . $e->getMessage()], 404);
        }
    }
}
