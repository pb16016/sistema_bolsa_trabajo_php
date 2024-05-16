<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use App\Models\Telefonos;

class TelefonosController extends Controller
{
    public function getAll()
    {
        try {
            $telefonos = Telefonos::all();
            return response()->json($telefonos);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los teléfonos. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function findByNumTel()
    {
        try {
            $numTelefono = request('numTelefono');
            $telefono = Telefonos::where('numTelefono', 'like', '%'.$numTelefono.'%')->first();

            // Verificar si se encontraron resultados
            if ($telefono) {
                $telefono->pais;
                $telefono->tipoTelefono;
                $telefono->entidad;
                return response()->json($telefono);
            }else{
                return response()->json(['error' => 'Teléfono no encontrado.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al buscar teléfono. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function findByNumDoc()
    {
        try {
            $numDocumento = request('numDocumento');
            $telefonos = Telefonos::where('numDocumento', $numDocumento)->get();

            // Verificar si se encontraron resultados
            if ($telefonos->isEmpty()) {
                return response()->json(['error' => 'Teléfono no encontrado.'], 404);
            }

            $response = [];
            foreach ($telefonos as $telefono) {
                $telefono->pais;
                $telefono->tipoTelefono;
                $telefono->entidad;
                $response[] = $telefono;
            }
            return response()->json($response);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al buscar teléfono. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'numTelefono' => 'required|unique:telefonos|max:20',
                'numDocumento' => 'required|max:20',
                'idTipoTelefono' => 'required|exists:tipotelefono,idTipoTelefono',
                'idPais' => 'required|exists:paises,idPais',
            ]);

            $telefono = Telefonos::create($request->all());
            return response()->json(['message' => 'Teléfono creado exitosamente.', 'data' => $telefono], 201);

        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al crear el Telefono. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el teléfono. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $numTelefono)
    {
        try {
            $request->validate([
                'numTelefono' => 'required|max:20',
                'numDocumento' => 'required|max:20',
                'idTipoTelefono' => 'required|exists:tipotelefono,idTipoTelefono',
                'idPais' => 'required|exists:paises,idPais',
            ]);
            
            $telefono = Telefonos::where('numTelefono', 'like', '%'.$numTelefono.'%')->firstOrFail();
            
            $telefono->update($request->all());
            return response()->json(['message' => 'Teléfono actualizado exitosamente.', 'data' => $telefono]);
            
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Teléfono no encontrada. Detalles: ' . $e->getMessage()], 404);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al actualizar el Teléfono. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el teléfono. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($numTelefono)
    {
        try {
            $telefono = Telefonos::where('numTelefono', 'like', '%'.$numTelefono.'%')->firstOrFail();
            $telefono->delete();

            return response()->json(['message' => 'Teléfono eliminado exitosamente.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Teléfono no encontrada. Detalles: ' . $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el teléfono. Detalles: ' . $e->getMessage()], 500);
        }
    }
}
