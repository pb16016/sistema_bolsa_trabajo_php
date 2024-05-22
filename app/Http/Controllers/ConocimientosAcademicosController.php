<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ConocimientosAcademicos;

class ConocimientosAcademicosController extends Controller
{
    public function getAll()
    {
        try {
            $conocimientos = ConocimientosAcademicos::all();
            return response()->json($conocimientos);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los conocimientos académicos. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById($idConocimiento)
    {
        try {
            $conocimiento = ConocimientosAcademicos::findOrFail($idConocimiento);
            return response()->json($conocimiento);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Conocimiento académico no encontrado. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'idCurriculum' => 'required|exists:cvs,idCurriculum',
                'tituloAcademico' => 'required|string|max:100',
                'institucion' => 'required|string|max:150',
                'fechaInicio' => 'required|date',
                'fechaTitulacion' => 'nullable|date|after_or_equal:fechaInicio|after_or_equal:fechaFin',
                'fechaFin' => 'nullable|date|after_or_equal:fechaInicio',
                'descripcion' => 'nullable|string|max:250',
            ]);

            $conocimiento = ConocimientosAcademicos::create($request->all());
            return response()->json(['message' => 'Conocimiento académico creado exitosamente.', 'data' => $conocimiento], Response::HTTP_CREATED);
        
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el conocimiento académico. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $idConocimiento)
    {
        try {
            $request->validate([
                'idCurriculum' => 'required|exists:cvs,idCurriculum',
                'tituloAcademico' => 'required|string|max:100',
                'institucion' => 'required|string|max:150',
                'fechaInicio' => 'required|date',
                'fechaTitulacion' => 'nullable|date|after_or_equal:fechaInicio|after_or_equal:fechaFin',
                'fechaFin' => 'nullable|date|after_or_equal:fechaInicio',
                'descripcion' => 'nullable|string|max:250',
            ]);
            
            $conocimiento = ConocimientosAcademicos::findOrFail($idConocimiento);
            $conocimiento->update($request->all());
            return response()->json(['message' => 'Conocimiento académico actualizado exitosamente.', 'data' => $conocimiento]);
        
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el conocimiento académico. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($idConocimiento)
    {
        try {
            $conocimiento = ConocimientosAcademicos::findOrFail($idConocimiento);
            $conocimiento->delete();
            return response()->json(['message' => 'Conocimiento académico eliminado exitosamente.']);
        
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el conocimiento académico. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
