<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\LogrosLabores;

class LogrosLaboresController extends Controller
{
    public function getAll()
    {
        try {
            $logros = LogrosLabores::all();
            return response()->json($logros, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los logros laborales'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById($idLogroLabor)
    {
        try {
            $logro = LogrosLabores::findOrFail($idLogroLabor);
            return response()->json($logro, Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Logro laboral no encontrado'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener el logro laboral'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    { 
        try {
            $validator = Validator::make($request->all(), [
                'idCurriculum' => 'required|exists:cvs,idCurriculum',
                'nombreLogroLabor' => 'required|string|max:100',
                'tipoLogroLabor' => 'required|string|max:50',
                'fechaRealizacion' => 'required|date',
                'descripcion' => 'nullable|string|max:250',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $logro = LogrosLabores::create($request->all());
            return response()->json(['message' => 'Logro o Labor creada exitosamente.', 'data' => $logro], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el logro laboral'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $idLogroLabor)
    {
        $validator = Validator::make($request->all(), [
            'idCurriculum' => 'required|exists:cvs,idCurriculum',
            'nombreLogroLabor' => 'required|string|max:100',
            'tipoLogroLabor' => 'required|string|max:50',
            'fechaRealizacion' => 'required|date',
            'descripcion' => 'nullable|string|max:250',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        try {
            $logro = LogrosLabores::findOrFail($idLogroLabor);
            $logro->update($request->all());
            return response()->json(['message' => 'Logro o Labor actualizado exitosamente.', 'data' => $logro], Response::HTTP_OK);
        
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Logro laboral no encontrado'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el logro laboral'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($idLogroLabor)
    {
        try {
            $logro = LogrosLabores::findOrFail($idLogroLabor);
            $logro->delete();
            return response()->json(['message' => 'Logro laboral eliminado exitosamente'], Response::HTTP_OK);
        
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Logro laboral no encontrado'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el logro laboral'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}