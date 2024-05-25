<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Profesiones;

class ProfesionesController extends Controller
{
    public function getAll()
    {
        try {
            $profesiones = Profesiones::all();
            return response()->json($profesiones);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las profesiones. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById($idProfesion)
    {
        try {
            $profesion = Profesiones::findOrFail($idProfesion);
            $profesion->cargo;
            return response()->json($profesion);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Profesión no encontrada. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }

    public function getCargos()
    {
        try {
            $idProfesion = request('idProfesion');
            $profesion = Profesiones::findOrFail($idProfesion);
            
            if (!is_null($profesion->cargos) && $profesion->cargos->isNotEmpty()) {
                $cargos = $profesion->cargos()->get();
                return response()->json($cargos);
            } else {
                return response()->json(["message" => "No se encontraron cargos para esta profesion."], Response::HTTP_NOT_FOUND);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "La profesión no se encontró."], Response::HTTP_NOT_FOUND);
        }
    }

    public function findCargoByIds()
    {
        try {
            $idProfesion = request('idProfesion');
            $profesion = Profesiones::findOrFail($idProfesion);
            
            if (!is_null($profesion->cargos)) {
                $cargos = $profesion->cargos;
                $idCargo = request('idCargo');
                $cargo = $profesion->cargos()->where('idCargo', $idCargo)->get();

                if (!is_null($cargo)) {
                    return response()->json($cargo);
                } else {
                    return response()->json(["message" => "No se encontró cargo con los id proporcionados."], Response::HTTP_NOT_FOUND);
                }
                
            } else {
                return response()->json(["message" => "No se encontraron cargos para esta profesión."], Response::HTTP_NOT_FOUND);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "La profesión no se encontró."], Response::HTTP_NOT_FOUND);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombreProfesion' => 'required|max:50',
                'descripcion' => 'nullable|string|max:250',
            ]);

            $profesion = Profesiones::create($request->all());

            return response()->json(['message' => 'Profesión creada exitosamente.', 'data' => $profesion], Response::HTTP_CREATED);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al crear la profesión. Detalles: ' . $e->errors()], 422);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Error al crear la profesión. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $idProfesion)
    {
        try {
            $request->validate([
                'nombreProfesion' => 'required|max:50',
                'descripcion' => 'nullable|string|max:250',
            ]);

            $profesion = Profesiones::findOrFail($idProfesion);
            $profesion->update($request->all());

            return response()->json(['message' => 'Profesión actualizada exitosamente.', 'data' => $profesion]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Profesión no encontrada. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al actualizar la profesión. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la profesión. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($idProfesion)
    {
        try {
            $profesion = Profesiones::findOrFail($idProfesion);
            $profesion->delete();

            return response()->json(['message' => 'Profesión eliminada exitosamente.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Profesión no encontrada. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la profesión. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
