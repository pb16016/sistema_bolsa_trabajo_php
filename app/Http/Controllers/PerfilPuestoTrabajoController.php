<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use App\Models\PerfilPuestoTrabajo;

class PerfilPuestoTrabajoController extends Controller
{
    public function getAll()
    {
        try {
            $perfilesPuesto = PerfilPuestoTrabajo::all();
            return response()->json($perfilesPuesto);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los perfiles de puesto de trabajo. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function findById()
    {
        try {
            $idPerfilPuesto = request('idPerfilPuesto');
            $perfilPuesto = PerfilPuestoTrabajo::findOrFail($idPerfilPuesto);
            
            if ($perfilPuesto) {
                $perfilPuesto->experienciaRequerida;
                return response()->json($perfilPuesto);
            } else {
                return response()->json(['message' => 'Perfil de puesto de trabajo no encontrado para el id proporcionado.']);
            }

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Perfil de puesto de trabajo no encontrado. Detalles: ' . $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al buscar el perfil de puesto de trabajo. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'numDocumento' => 'required|exists:empresas,numDocumento',
                'nombrePuesto' => 'required|string|max:50',
                'rangoSalarial' => 'required|string|max:20',
                'modalidadTrabajo' => 'required|in:Presencial,Remoto,Híbrido',
                'ubicacionGeografica' => 'required|string|max:250',
                'beneficios' => 'required|string|max:250',
                'gradoAcademicoMinimo' => 'required|string|max:100',
                'idExperienciaRequerida' => 'required|exists:experienciarequerida,idExperienciaRequerida',
                'requisitosAdicionales' => 'nullable|string|max:250',
            ]);

            $perfilPuesto = PerfilPuestoTrabajo::create($request->all());
            return response()->json(['message' => 'Perfil de puesto de trabajo creado exitosamente.', 'data' => $perfilPuesto], 201);
        
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al crear el perfil de puesto de trabajo. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el perfil de puesto de trabajo. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $idPerfilPuesto)
    {
        try {
            $request->validate([
                'numDocumento' => 'required|exists:empresas,numDocumento',
                'nombrePuesto' => 'required|string|max:50',
                'rangoSalarial' => 'required|string|max:20',
                'modalidadTrabajo' => 'required|in:Presencial,Remoto,Híbrido',
                'ubicacionGeografica' => 'required|string|max:250',
                'beneficios' => 'required|string|max:250',
                'gradoAcademicoMinimo' => 'required|string|max:100',
                'idExperienciaRequerida' => 'required|exists:experienciarequerida,idExperienciaRequerida',
                'requisitosAdicionales' => 'nullable|string|max:250',
            ]);

            $perfilPuesto = PerfilPuestoTrabajo::findOrFail($idPerfilPuesto);
            $perfilPuesto->update($request->all());
            return response()->json(['message' => 'Perfil de puesto de trabajo actualizado exitosamente.', 'data' => $perfilPuesto]);
        
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Perfil de puesto de trabajo no encontrado. Detalles: ' . $e->getMessage()], 404);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al actualizar el perfil de puesto de trabajo. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el perfil de puesto de trabajo. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($idPerfilPuesto)
    {
        try {
            $perfilPuesto = PerfilPuestoTrabajo::findOrFail($idPerfilPuesto);
            $perfilPuesto->delete();
            return response()->json(['message' => 'Perfil de puesto de trabajo eliminado exitosamente.']);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Perfil de puesto de trabajo no encontrado. Detalles: ' . $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el perfil de puesto de trabajo. Detalles: ' . $e->getMessage()], 500);
        }
    }
}
