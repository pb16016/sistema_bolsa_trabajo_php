<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResultadoPruebas;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ResultadoPruebasController extends Controller
{
    public function getAll()
    {
        try {
            $resultados = ResultadoPruebas::all();
            return response()->json($resultados, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los resultados de las pruebas'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById($idResultadoPrueba)
    {
        try {
            $resultado = ResultadoPruebas::findOrFail($idResultadoPrueba);
            return response()->json($resultado, Response::HTTP_OK);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Resultado de prueba no encontrado'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener el resultado de la prueba'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idCurriculum' => 'required|exists:cvs,idCurriculum',
            'nombrePrueba' => 'required|string|max:100',
            'tipoPrueba' => 'required|string|max:40',
            'resultadoObtenido' => 'required|string|max:20',
            'fechaRealizacion' => 'required|date',
            'urlResultadoPrueba' => 'nullable|url|max:250',
            'descripcion' => 'nullable|string|max:250',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        try {
            $resultado = ResultadoPruebas::create($request->all());
            return response()->json(['message' => 'Resultado de prueba eliminado exitosamente', 'data' => $resultado], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el resultado de la prueba'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $idResultadoPrueba)
    {
        $validator = Validator::make($request->all(), [
            'idCurriculum' => 'required|exists:cvs,idCurriculum',
            'nombrePrueba' => 'required|string|max:100',
            'tipoPrueba' => 'required|string|max:40',
            'resultadoObtenido' => 'required|string|max:20',
            'fechaRealizacion' => 'required|date',
            'urlResultadoPrueba' => 'nullable|url|max:250',
            'descripcion' => 'nullable|string|max:250',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        try {
            $resultado = ResultadoPruebas::findOrFail($idResultadoPrueba);
            $resultado->update($request->all());
            return response()->json(['message' => 'Resultado de prueba eliminado exitosamente', 'data' => $resultado], Response::HTTP_OK);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Resultado de prueba no encontrado'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el resultado de la prueba'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($idResultadoPrueba)
    {
        try {
            $resultado = ResultadoPruebas::findOrFail($idResultadoPrueba);
            $resultado->delete();
            return response()->json(['message' => 'Resultado de prueba eliminado exitosamente'], Response::HTTP_OK);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Resultado de prueba no encontrado'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el resultado de la prueba'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
