<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Recomendaciones;

class RecomendacionesController extends Controller
{
    public function getAll()
    {
        try {
            $recomendaciones = Recomendaciones::all();
            return response()->json($recomendaciones);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las recomendaciones. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById($idRecomendacion)
    {
        try {
            $recomendacion = Recomendaciones::findOrFail($idRecomendacion);
            return response()->json($recomendacion);
            
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Recomendación no encontrada.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener la recomendación. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'idCurriculum' => 'required|exists:cvs,idCurriculum',
                'tipoRecomendacion' => 'required|in:Personal,Laboral',
                'nombresRecomendador' => 'required|string|max:40',
                'apellidosRecomendador' => 'required|string|max:40',
                'cargoRecomendador' => 'nullable|string|max:70',
                'parentescoRecomendador' => 'nullable|string|max:15',
                'telefonoContacto' => 'required|string|max:15',
                'emailContacto' => 'nullable|string|max:50|email',
            ]);

            $recomendacion = Recomendaciones::create($request->all());

            return response()->json(['message' => 'Recomendación creada exitosamente.', 'data' => $recomendacion], Response::HTTP_CREATED);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al crear la recomendación. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la recomendación. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $idRecomendacion)
    {
        try {
            $request->validate([
                'idCurriculum' => 'required|exists:cvs,idCurriculum',
                'tipoRecomendacion' => 'required|in:Personal,Laboral',
                'nombresRecomendador' => 'required|string|max:40',
                'apellidosRecomendador' => 'required|string|max:40',
                'cargoRecomendador' => 'nullable|string|max:70',
                'parentescoRecomendador' => 'nullable|string|max:15',
                'telefonoContacto' => 'required|string|max:15',
                'emailContacto' => 'nullable|string|max:50|email',
            ]);

            $recomendacion = Recomendaciones::findOrFail($idRecomendacion);
            $recomendacion->update($request->all());

            return response()->json(['message' => 'Recomendación actualizada exitosamente.', 'data' => $recomendacion]);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al actualizar la recomendación. Detalles: ' . $e->errors()], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Recomendación no encontrada.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la recomendación. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($idRecomendacion)
    {
        try {
            $recomendacion = Recomendaciones::findOrFail($idRecomendacion);
            $recomendacion->delete();

            return response()->json(['message' => 'Recomendación eliminada exitosamente.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Recomendación no encontrada.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la recomendación. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
