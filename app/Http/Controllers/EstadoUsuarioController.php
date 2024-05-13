<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstadoUsuario;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EstadoUsuarioController extends Controller
{
    public function getAll()
    {
        try {
            $estadosUsuario = EstadoUsuario::all();
            return response()->json($estadosUsuario);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ha ocurrido un error al obtener los estados de usuario. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function findById($idEstadoUsuario)
    {
        try {
            $estadoUsuario = EstadoUsuario::findOrFail($idEstadoUsuario);
            return response()->json($estadoUsuario);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Estado de usuario no encontrado. Detalles: ' . $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ha ocurrido un error al obtener el estado de usuario. Detalles: ' . $e->getMessage()], 500);
        }
    }
}
