<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HabilidadesTecnicas;

class HabilidadesTecnicasController extends Controller
{
    public function getAll()
    {
        try {
            $habilidadesTecnicas = HabilidadesTecnicas::all();
            return response()->json($habilidadesTecnicas);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las habilidades técnicas. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById($idHabilidadTecnica)
    {
        try {
            $habilidadTecnica = HabilidadesTecnicas::findOrFail($idHabilidadTecnica);
            if (!$habilidadTecnica) {
                return response()->json(['error' => 'Habilidad técnica no encontrada.'], Response::HTTP_NOT_FOUND);
            }
            return response()->json($habilidadTecnica);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al buscar habilidad técnica. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'idCurriculum' => 'required|integer|exists:cvs,idCurriculum',
                'nombreHabilidad' => 'required|string|max:70',
                'tipoHabilidad' => 'required|string|max:20',
                'descripcion' => 'nullable|string|max:250',
            ]);

            $habilidadTecnica = HabilidadesTecnicas::create($request->all());
            return response()->json(['message' => 'Habilidad técnica creada exitosamente.', 'data' => $habilidadTecnica]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la habilidad técnica. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $idHabilidadTecnica)
    {
        try {
            $request->validate([
                'idCurriculum' => 'required|integer|exists:cvs,idCurriculum',
                'nombreHabilidad' => 'required|string|max:70',
                'tipoHabilidad' => 'required|string|max:20',
                'descripcion' => 'nullable|string|max:250',
            ]);

            $habilidadTecnica = HabilidadesTecnicas::findOrFail($idHabilidadTecnica);
            if (!$habilidadTecnica) {
                return response()->json(['error' => 'Habilidad técnica no encontrada.'], Response::HTTP_NOT_FOUND);
            }

            $habilidadTecnica->update($request->all());
            return response()->json(['message' => 'Habilidad técnica actualizada exitosamente.', 'data' => $habilidadTecnica]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la habilidad técnica. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($idHabilidadTecnica)
    {
        try {
            $habilidadTecnica = HabilidadesTecnicas::findOrFail($idHabilidadTecnica);
            if (!$habilidadTecnica) {
                return response()->json(['error' => 'Habilidad técnica no encontrada.'], Response::HTTP_NOT_FOUND);
            }

            $habilidadTecnica->delete();
            return response()->json(['message' => 'Habilidad técnica eliminada exitosamente.']);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la habilidad técnica. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
