<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ExperienciasLaborales;

class ExperienciasLaboralesController extends Controller
{
    public function getAll()
    {
        try {
            $experiencias = ExperienciasLaborales::all();
            return response()->json($experiencias);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las experiencias laborales. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById($idExperienciaLaboral)
    {
        try {
            $experiencia = ExperienciasLaborales::findOrFail($idExperienciaLaboral);
            return response()->json($experiencia);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Experiencia laboral no encontrada. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'idCurriculum' => 'required|exists:cvs,idCurriculum',
                'periodoInicio' => 'required|date',
                'periodoFin' => 'required|date|after:periodoInicio',
                'funcionesDesempeñadas' => 'required|string|max:250',
                'cargoDesempeñado' => 'required|string|max:80',
                'nombreOrganizacion' => 'required|string|max:50',
                'contactoOrganizacion' => 'nullable|string|max:40',
                'descripcion' => 'nullable|string|max:250',
            ]);

            $experiencia = ExperienciasLaborales::create($request->all());
            return response()->json(['message' => 'Experiencia laboral creada exitosamente.', 'data' => $experiencia], Response::HTTP_CREATED);

        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al crear la experiencia laboral. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la experiencia laboral. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $idExperienciaLaboral)
    {
        try {
            $experiencia = ExperienciasLaborales::findOrFail($idExperienciaLaboral);

            $request->validate([
                'idCurriculum' => 'required|exists:cvs,idCurriculum',
                'periodoInicio' => 'required|date',
                'periodoFin' => 'required|date|after:periodoInicio',
                'funcionesDesempeñadas' => 'required|string|max:250',
                'cargoDesempeñado' => 'required|string|max:80',
                'nombreOrganizacion' => 'required|string|max:50',
                'contactoOrganizacion' => 'nullable|string|max:40',
                'descripcion' => 'nullable|string|max:250',
            ]);

            $experiencia->update($request->all());
            return response()->json(['message' => 'Experiencia laboral actualizada exitosamente.', 'data' => $experiencia]);

        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al actualizar la experiencia laboral. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la experiencia laboral. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($idExperienciaLaboral)
    {
        try {
            $experiencia = ExperienciasLaborales::findOrFail($idExperienciaLaboral);
            $experiencia->delete();

            return response()->json(['message' => 'Experiencia laboral eliminada exitosamente.']);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la experiencia laboral. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}