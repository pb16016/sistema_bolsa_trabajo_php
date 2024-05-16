<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoDocumento;

class TipoDocumentoController extends Controller
{
    public function getAll()
    {
        try {
            $tipoDocumento = TipoDocumento::all();
            return response()->json($tipoDocumento);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los registros. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function findByCod($idTipoDocumento)
    {
        try {
            $tipoDocumento = TipoDocumento::findOrFail($idTipoDocumento);
            return response()->json($tipoDocumento);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Tipo de documento no encontrado. Detalles: ', 'error' => $e->getMessage()], 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'idTipoDocumento' => 'required|unique:tipodocumento|max:3',
                'tipoDocumento' => 'required|max:15',
                'descripcion' => 'max:250',
            ]);
            $tipoDocumento = TipoDocumento::create($request->all());

            return response()->json(['message' => 'Tipo de documento creado exitosamente.', 'data' => $tipoDocumento], 201);
        } catch (\Exceptio $e) {
            return response()->json(['message' => 'Error al crear el tipo de documento.', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $idTipoDocumento)
    {
        try {
            $request->validate([
                'tipoDocumento' => 'required|max:15',
                'descripcion' => 'max:250',
            ]);

            $tipoDocumento = TipoDocumento::findOrFail($idTipoDocumento);
            $tipoDocumento->update($request->all());

            return response()->json(['message' => 'Tipo de documento actualizado exitosamente.', 'data' => $tipoDocumento]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ha ocurrido un error al actualizar el tipo de documento. Detalles: ' . $e->getMessage()], 500);
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
            return response()->json(['error' => 'Ha ocurrido un error al eliminar el tipo de documento. Detalles: ' . $e->getMessage()], 500);
        }
    }

}
