<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaNivel;
use Symfony\Component\HttpFoundation\Response;

class CategoriaNivelController extends Controller
{
    public function getAll()
    {
        try {
            $categoriasNivel = CategoriaNivel::all();
            return response()->json($categoriasNivel);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las categorías de nivel. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById($idCategoriaNivel)
    {
        try {
            $categoriaNivel = CategoriaNivel::findOrFail($idCategoriaNivel);
            return response()->json($categoriaNivel);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Categoria de Nivel no encontrado. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }
}
