<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\TipoDocumento;

class TipoDocumentoController extends Controller
{
    public function getAll()
    {
        try {
            $tipoDocumento = TipoDocumento::all();
            return response()->json($tipoDocumento);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los registros. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findByCod($idTipoDocumento)
    {
        try {
            $tipoDocumento = TipoDocumento::findOrFail($idTipoDocumento);
            return response()->json($tipoDocumento);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Tipo de documento no encontrado. Detalles: ', 'error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'idTipoDocumento' => 'required|unique:tipodocumento|max:3',
                'tipoDocumento' => 'required|max:15',
                'descripcion' => 'max:250',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $tipoDocumento = TipoDocumento::create($request->all());

            return response()->json(['message' => 'Tipo de documento creado exitosamente.', 'data' => $tipoDocumento], Response::HTTP_CREATED);
        } catch (\Exceptio $e) {
            return response()->json(['message' => 'Error al crear el tipo de documento.', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $idTipoDocumento)
    {
        try {
            $validator = Validator::make($request->all(), [
                'idTipoDocumento' => 'required|unique:tipodocumento|max:3',
                'tipoDocumento' => 'required|max:15',
                'descripcion' => 'max:250',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $tipoDocumento = TipoDocumento::findOrFail($idTipoDocumento);
            $tipoDocumento->update($request->all());

            return response()->json(['message' => 'Tipo de documento actualizado exitosamente.', 'data' => $tipoDocumento]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ha ocurrido un error al actualizar el tipo de documento. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($idTipoDocumento)
    {
        try {
            $tipoDocumento = TipoDocumento::findOrFail($idTipoDocumento);
            $tipoDocumento->delete();
    
            return response()->json(['message' => 'Tipo de documento eliminado exitosamente.']);
        } catch (\Exception $e) {
            // Manejo de la excepción
            return response()->json(['error' => 'Ha ocurrido un error al eliminar el tipo de documento. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
