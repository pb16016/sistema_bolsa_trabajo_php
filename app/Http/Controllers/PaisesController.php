<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Paises;

class PaisesController extends Controller
{

    public function getAll()
    {
        try {
            $paises = Paises::all();
            return response()->json($paises);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los registros. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById()
    {
        try {
            $idPais = request('idPais');
            $pais = Paises::findOrFail($idPais);
            return response()->json($pais);
        } catch (\Exception $e) {
            return response()->json(['error' => 'País no encontrado. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }

    public function getDepartments()
    {
        try {
            $idPais = request('idPais');
            $pais = Paises::findOrFail($idPais);
            
            if (!is_null($pais->departamentos) && $pais->departamentos->isNotEmpty()) {
                $departments = $pais->departamentos()->get();
                return response()->json($departments);
            } else {
                return response()->json(["message" => "No se encontraron departamentos para este país."], Response::HTTP_NOT_FOUND);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "El país no se encontró."], Response::HTTP_NOT_FOUND);
        }
    }

    public function findDepartmentByCod()
    {
        try {
            $idPais = request('idPais');
            $pais = Paises::findOrFail($idPais);
            
            if (!is_null($pais->departamentos) && $pais->departamentos->isNotEmpty()) {
                $codDepartamento = request('codDepartamento');

                $department = $pais->departamentos()->where('codDepartamento', $codDepartamento)->get();
                if ($department->isEmpty()) {
                    return response()->json(["message" => "No se encontraron departamentos para el código proporcionado."], Response::HTTP_NOT_FOUND);
                }

                return response()->json($department);
            } else {
                return response()->json(["message" => "No se encontraron departamentos para este país."], Response::HTTP_NOT_FOUND);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "El registro no se encontró."], Response::HTTP_NOT_FOUND);
        }
    }
}
