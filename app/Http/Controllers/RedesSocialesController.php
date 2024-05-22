<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\RedesSociales;

class RedesSocialesController extends Controller
{
    // Método para mostrar todas las redes sociales
    public function getAll()
    {
        try {
            $redesSociales = RedesSociales::all();
        return response()->json($redesSociales);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las redes sociales. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Método para mostrar una red social específica por su número de documento
    public function findByNumDoc()
    {
        try {
            $numDocumento = request('numDocumento');
            $redesSociales = RedesSociales::where('numDocumento', $numDocumento)->first();

            if ($redesSociales) {
                return response()->json($redesSociales);
            } else {
                return response()->json(['message' => 'No se encontró las redes sociales para el número de documento proporcionado.'], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las redes sociales. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Método para crear una nueva red social
    public function store(Request $request)
    {
        try {
            $redesSociales = RedesSociales::create($request->all());
            return response()->json(['message' => 'Redes sociales creada exitosamente.', 'data' => $redesSociales], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear las redes sociales. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Método para actualizar una red social por su número de documento
    public function update(Request $request, $numDocumento)
    {
        try {
            $redesSociales = RedesSociales::where('numDocumento', $numDocumento)->first();

            if ($redesSociales) {
                $redesSociales->update($request->all());
                return response()->json(['message' => 'Redes sociales actualizada exitosamente.', 'data' => $redesSociales]);
            } else {
                return response()->json(['error' => 'No se encontraron redes sociales para el número de documento proporcionado.'], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar las redes sociales. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Método para eliminar una red social por su número de documento
    public function destroy($numDocumento)
    {
        try {
            $redesSociales = RedesSociales::where('numDocumento', $numDocumento)->first();

            if ($redesSociales) {
                $redesSociales->delete();
                return response()->json(['message' => 'Red social eliminada exitosamente.']);
            } else {
                return response()->json(['error' => 'No se encontró las redes sociales para el número de documento proporcionado.'], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar las redes sociales. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
