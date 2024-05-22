<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargos;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

class CargosController extends Controller
{
    public function getAll()
    {
        try {
            $cargos = Cargos::all();
            return response()->json($cargos);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los cargos. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById($id)
    {
        try {
            $cargo = Cargos::findOrFail($id);
            return response()->json($cargo);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Cargo no encontrado. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al buscar el cargo. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombreCargo' => 'required|max:50',
                'descripcion' => 'max:250',
            ]);

            $cargo = Cargos::create($request->all());

            return response()->json(['message' => 'Cargo creado exitosamente.', 'data' => $cargo], Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error al crear el cargo. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $idCargo)
    {
        try {
            $request->validate([
                'nombreCargo' => 'required|max:50',
                'descripcion' => 'max:250',
            ]);

            $cargo = Cargos::findOrFail($idCargo);
            $cargo->update($request->all());

            return response()->json(['message' => 'Cargo actualizado exitosamente.', 'data' => $cargo]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Cargo no encontrado. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el cargo. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($idCargo)
    {
        try {
            $cargo = Cargos::findOrFail($idCargo);
            $cargo->delete();

            return response()->json(['message' => 'Cargo eliminado exitosamente.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Cargo no encontrado. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el cargo. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getProfesiones()
    {
        try {
            $idCargo = request('idCargo');
            $cargo = Cargos::findOrFail($idCargo);
            
            if (!is_null($cargo->profesiones) && $cargo->profesiones->isNotEmpty()) {
                $profesiones = $cargo->profesiones()->get();
                return response()->json($profesiones);
            } else {
                return response()->json(["message" => "No se encontraron municipios para este departamento."], Response::HTTP_NOT_FOUND);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "La profesión no se encontró."], Response::HTTP_NOT_FOUND);
        }
    }

    public function findProfesionById()
    {
        try {
            $idCargo = request('idCargo');
            $cargo = Cargos::findOrFail($idCargo);
            
            if (!is_null($cargo->profesiones) && $cargo->profesiones->isNotEmpty()) {
                $idProfesion = request('idProfesion');
                $profesion = $cargo->profesiones()->where('idProfesion', $idProfesion)->get();

                if ($profesion->isEmpty()) {
                    return response()->json(["message" => "No se encontró profesión para el id proporcionado."], Response::HTTP_NOT_FOUND);
                }
                
                return response()->json($profesion);
            } else {
                return response()->json(["message" => "No se encontraron profesiones para este cargo."], Response::HTTP_NOT_FOUND);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "El Cargo no se encontró."], Response::HTTP_NOT_FOUND);
        }
    }
}