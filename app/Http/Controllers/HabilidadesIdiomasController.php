<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\HabilidadesIdiomas;

class HabilidadesIdiomasController extends Controller
{
    public function getAll()
    {
        try {
            $habilidadesIdiomas = HabilidadesIdiomas::all();
            return response()->json($habilidadesIdiomas);
        
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las habilidades de idiomas. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById($idHabilidadIdioma)
    {
        try {
            $habilidadIdioma = HabilidadesIdiomas::findOrFail($idHabilidadIdioma);
            return response()->json($habilidadIdioma);
        
        } catch (\Exception $e) {
            return response()->json(['error' => 'Habilidad de idioma no encontrada. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'idCurriculum' => 'required|exists:cvs,idCurriculum',
                'idioma' => 'required|string|max:12',
                'nivelEscritura' => 'required|string|max:15',
                'nivelLectura' => 'required|string|max:15',
                'nivelConversacion' => 'required|string|max:15',
                'nivelEscucha' => 'required|string|max:15',
                'idCategoriaNivel' => 'required|exists:categorianivel,idCategoriaNivel',
            ]);

            $habilidadIdioma = HabilidadesIdiomas::create($request->all());
            return response()->json(['message' => 'Habilidad de idioma creada exitosamente.', 'data' => $habilidadIdioma], Response::HTTP_CREATED);
        
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al crear la habilidad de idioma. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la habilidad de idioma. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $idHabilidadIdioma)
    {
        try {
            $request->validate([
                'idCurriculum' => 'required|exists:cvs,idCurriculum',
                'idioma' => 'required|string|max:12',
                'nivelEscritura' => 'required|string|max:15',
                'nivelLectura' => 'required|string|max:15',
                'nivelConversacion' => 'required|string|max:15',
                'nivelEscucha' => 'required|string|max:15',
                'idCategoriaNivel' => 'required|exists:categorianivel,idCategoriaNivel',
            ]);

            $habilidadIdioma = HabilidadesIdiomas::findOrFail($idHabilidadIdioma);
            $habilidadIdioma->update($request->all());
            return response()->json(['message' => 'Habilidad de idioma actualizada exitosamente.', 'data' => $habilidadIdioma]);
        
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la habilidad de idioma. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($idHabilidadIdioma)
    {
        try {
            $habilidadIdioma = HabilidadesIdiomas::findOrFail($idHabilidadIdioma);
            $habilidadIdioma->delete();
            return response()->json(['message' => 'Habilidad de idioma eliminada exitosamente.']);
        
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la habilidad de idioma. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}