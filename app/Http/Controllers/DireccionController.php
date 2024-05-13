<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DireccionController extends Controller
{
    public function getAll()
    {
        try {
            $direcciones = Direccion::all();
            return response()->json($direcciones);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los registros. Detalles: ' . $e->getMessage()], 500);
        }
    }

    // Método para encontrar una dirección por su ID
    public function findByid($idDireccion)
    {
        try {
            $direccion = Direccion::findOrFail($idDireccion);
            $direccion->municipio->departamento->pais;

            return response()->json($direccion);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Dirección no encontrada. Detalles: ' . $e->getMessage()], 404);
        }
    }

    // Método para crear una nueva dirección
    public function store(Request $request)
    {
        try {
            $request->validate([
                'direccion' => 'required|string|max:200',
                'detalleDireccion' => 'required|string|max:250',
                'codMunicipio' => 'required|string|max:6'
            ]);

            $direccion = Direccion::create($request->all());

            return response()->json(['message' => 'Dirección creada exitosamente.', 'data' => $direccion], 201);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error al crear la dirección.', 'error' => $e->getMessage()], 500);
        }
    }

    // Método para actualizar una dirección existente
    public function update(Request $request, $idDireccion)
    {
        try {
            $request->validate([
                'direccion' => 'required|string|max:200',
                'detalleDireccion' => 'required|string|max:250',
                'codMunicipio' => 'required|string|max:6'
            ]);

            $direccion = Direccion::findOrFail($idDireccion);
            $direccion->update($request->all());

            return response()->json(['message' => 'Dirección actualizada exitosamente.', 'data' => $direccion]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ha ocurrido un error al actualizar la dirección. Detalles: ' . $e->getMessage()], 500);
        }
    }

    // Método para eliminar una dirección
    public function destroy($idDireccion)
    {
        try {
            $direccion = Direccion::findOrFail($idDireccion);
            $direccion->delete();

            return response()->json(['message' => 'Dirección eliminada exitosamente.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ha ocurrido un error al eliminar la dirección. Detalles: ' . $e->getMessage()], 500);
        }
    }
}
