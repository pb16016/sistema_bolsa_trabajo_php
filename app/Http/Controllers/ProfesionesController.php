<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesiones;

class ProfesionesController extends Controller
{
    public function getAll()
    {
        try {
            $profesiones = Profesiones::all();
            return response()->json($profesiones);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las profesiones. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function findById($idProfesion)
    {
        try {
            $profesion = Profesiones::findOrFail($idProfesion);
            $profesion->cargo;
            return response()->json($profesion);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Profesión no encontrada. Detalles: ' . $e->getMessage()], 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombreProfesion' => 'required|max:50',
                'idCargo' => 'required|exists:cargos,idCargo',
            ]);

            $profesion = Profesiones::create($request->all());

            return response()->json(['message' => 'Profesión creada exitosamente.', 'data' => $profesion], 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al crear la profesión. Detalles: ' . $e->errors()], 422);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Error al crear la profesión. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $idProfesion)
    {
        try {
            $request->validate([
                'nombreProfesion' => 'required|max:50',
                'idCargo' => 'required|exists:cargos,idCargo',
            ]);

            $profesion = Profesiones::findOrFail($idProfesion);
            $profesion->update($request->all());

            return response()->json(['message' => 'Profesión actualizada exitosamente.', 'data' => $profesion]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Profesión no encontrada. Detalles: ' . $e->getMessage()], 404);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al actualizar la profesión. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la profesión. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($idProfesion)
    {
        try {
            $profesion = Profesiones::findOrFail($idProfesion);
            $profesion->delete();

            return response()->json(['message' => 'Profesión eliminada exitosamente.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Profesión no encontrada. Detalles: ' . $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la profesión. Detalles: ' . $e->getMessage()], 500);
        }
    }
}
