<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipios;

class MunicipiosController extends Controller
{
    public function getAll()
    {
        try {
            // Obtener todos los municipios
            $municipios = Municipios::all();
            return response()->json($municipios);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los registros. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function findByCod()
    {
        try {
            $codMunicipio = request('codMunicipio');
            $municipio = Municipios::findOrFail($codMunicipio);
            $municipio->departamento->pais;

            return response()->json($municipio);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Municipio no encontrado. Detalles: ' . $e->getMessage()], 404);
        }
    }
}
