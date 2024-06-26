<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Departamentos;

class DepartamentosController extends Controller
{
    public function getAll()
        {
            try {
            $departamentos = Departamentos::all();
            return response()->json($departamentos);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los registros. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getMunicipalities()
    {
        try {
            $codDepartamento = request('codDepartamento');
            $departamento = Departamentos::findOrFail($codDepartamento);
        
            if (!is_null($departamento->municipios) && $departamento->municipios->isNotEmpty()) {
                $municipalities = $departamento->municipios()->get();
                
                return response()->json($municipalities);
            } else {
                return response()->json(["message" => "No se encontraron municipios para este departamento."], Response::HTTP_NOT_FOUND);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "El departamento no se encontró."], Response::HTTP_NOT_FOUND);
        }
    }

    public function findMunicipalityByCod()
    {
        try {
            $codDepartamento = request('codDepartamento');
            $departamento = Departamentos::findOrFail($codDepartamento);
            
            if (!is_null($departamento->municipios) && $departamento->municipios->isNotEmpty()) {
                $codMunicipio = request('codMunicipio');

                $municipio = $departamento->municipios->where('codMunicipio', $codMunicipio);

                if ($municipio->isEmpty()) {
                    return response()->json(["message" => "No se encontraron Municipios para el código proporcionado."], Response::HTTP_NOT_FOUND);
                }

                return response()->json($municipio);
            } else {
                return response()->json(["message" => "No se encontraron municipios para este departamento."], Response::HTTP_NOT_FOUND);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "El departamento no se encontró."], Response::HTTP_NOT_FOUND);
        }
    }
}