<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ExperienciaRequerida;

class ExperienciaRequeridaController extends Controller
{
    public function getAll()
    {
        try {
            $experiencias = ExperienciaRequerida::all();
            return response()->json($experiencias);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las experiencias requeridas. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById()
    {
        try {
            $idExperienciaRequerida = request('idExperienciaRequerida');
            $experiencia = ExperienciaRequerida::findOrFail($idExperienciaRequerida);
            
            if ($experiencia) {
                $experiencia->cargo;
                return response()->json($experiencia);
            } else {
                return response()->json(['message' => 'Experiencia requerida no encontrada para el id proporcionado.']);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Experiencia requerida no encontrada. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al buscar la experiencia requerida. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'idCargo' => 'required|exists:cargos,idCargo',
                'conocimientosRequeridos' => 'required|string|max:250',
                'habilidadesRequeridas' => 'required|string|max:250',
                'tiempoMinimoCargo' => 'required|string|max:25',
                'descripcion' => 'nullable|string|max:250',
            ]);

            $experiencia = ExperienciaRequerida::create($request->all());
            return response()->json(['message' => 'Experiencia requerida creada exitosamente.', 'data' => $experiencia], Response::HTTP_CREATED);
        
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al crear la experiencia requerida. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la experiencia requerida. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $idExperienciaRequerida)
    {
        try {
            $request->validate([
                'idCargo' => 'required|exists:cargos,idCargo',
                'conocimientosRequeridos' => 'required|string|max:250',
                'habilidadesRequeridas' => 'required|string|max:250',
                'tiempoMinimoCargo' => 'required|string|max:25',
                'descripcion' => 'nullable|string|max:250',
            ]);

            $experiencia = ExperienciaRequerida::findOrFail($idExperienciaRequerida);
            $experiencia->update($request->all());
            return response()->json(['message' => 'Experiencia requerida actualizada exitosamente.', 'data' => $experiencia]);
        
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Experiencia requerida no encontrada. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al actualizar la experiencia requerida. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la experiencia requerida. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($idExperienciaRequerida)
    {
        try {
            $experiencia = ExperienciaRequerida::findOrFail($idExperienciaRequerida);
            $experiencia->delete();
            return response()->json(['message' => 'Experiencia requerida eliminada exitosamente.']);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Experiencia requerida no encontrada. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la experiencia requerida. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}