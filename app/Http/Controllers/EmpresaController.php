<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Empresa;

class EmpresaController extends Controller
{
    public function getAll()
    {
        try {
            $empresas = Empresa::all();
            return response()->json($empresas);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las empresas. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function findByNumDoc()
    {
        try {
            $numDocumento = request('numDocumento');
            $empresa = Empresa::findOrFail($numDocumento);
            $empresa->tipoDocumento;
            $empresa->direccion->municipio->departamento->pais;

            if ($empresa) {
                return response()->json($empresa);
            } else {
                return response()->json(['message' => 'Empresa no encontrada para el número de documento proporcionado.']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Empresa no encontrada. Detalles: ' . $e->getMessage()], 404);
        }
    }

    public function findEmailByNumDoc()
    {
        try {
            $numDocumento = request('numDocumento');
            $empresa = Empresa::findOrFail($numDocumento);

            if ($empresa) {
                $email = $empresa->emailEmpresa;
                return response()->json(['emailEmpresa' => $email]);

            } else {
                return response()->json(['message' => 'Empresa no encontrada para el número de documento proporcionado.']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Empresa no encontrada. Detalles: ' . $e->getMessage()], 404);
        }
    }

    public function findByNombre()
    {
        try {
            $nombreEmpresa = request('nombreEmpresa');
            $empresa = Empresa::where('nombreComercialEmpresa', 'like', '%'.$nombreEmpresa.'%')
                        ->orWhere('nombreLegalEmpresa', 'like', '%'.$nombreEmpresa.'%')
                        ->first();

            if ($empresa) {
                $empresa->tipoDocumento;
                $empresa->direccion->municipio->departamento->pais;

                return response()->json($empresa);
            } else {
                return response()->json(['message' => 'Empresa no encontrada para el nombre proporcionado.']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al buscar empresa por nombre. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function findByRubro()
    {
        try {
            $rubroEmpresa = request('rubroEmpresa');
            $empresa = Empresa::where('rubro', 'like', '%'.$rubroEmpresa.'%')->first();

            if ($empresa) {
                $empresa->tipoDocumento;
                $empresa->direccion->municipio->departamento->pais;

                return response()->json($empresa);
            } else {
                return response()->json(['message' => 'Empresa no encontrada para el rubro proporcionado.']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al buscar empresa por rubro. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function getTipoDocumento()
    {
        try {
            $numDocumento = request('numDocumento');
            $empresa = Empresa::findOrFail($numDocumento);

            if (!is_null($empresa->tipoDocumento)) {
                $tipoDocumento = $empresa->tipoDocumento()->get();

                return response()->json($tipoDocumento);
            } else {
                return response()->json(["message" => "No se encontraron tipo de documentos para esta empresa."], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener el tipo de documento de la empresa. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function getDireccion()
    {
        try {
            $numDocumento = request('numDocumento');
            $empresa = Empresa::findOrFail($numDocumento);
            
            if (!is_null($empresa->direccion)) {
                $direccion = $empresa->direccion;
                $empresa->direccion->municipio->departamento->pais;

                return response()->json($direccion);
            } else {
                return response()->json(["message" => "No se encontró una dirección para esta empresa."], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener la dirección de la empresa. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'numDocumento' => 'required|max:20',
                'nombreComercialEmpresa' => 'required|max:60',
                'nombreLegalEmpresa' => 'required|max:60',
                'rubro' => 'required|max:15',
                'emailEmpresa' => 'required|email|max:50',
                'idPais' => 'required|exists:paises,idPais',
                'idDireccion' => 'required|exists:direccion,idDireccion',
                'idTipoDocumento' => 'required|exists:tipodocumento,idTipoDocumento',
            ]);

            $empresa = Empresa::create($request->all());

            return response()->json(['message' => 'Empresa creada exitosamente.', 'data' => $empresa], 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al crear la empresa. Detalles: ' . $e->errors()], 422);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Error al crear la empresa. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $numDocumento)
    {
        try {
            $request->validate([
                'nombreComercialEmpresa' => 'required|max:60',
                'nombreLegalEmpresa' => 'required|max:60',
                'rubro' => 'required|max:15',
                'emailEmpresa' => 'required|email|max:50',
                'idPais' => 'required|exists:paises,idPais',
                'idDireccion' => 'required|exists:direccion,idDireccion',
                'idTipoDocumento' => 'required|exists:tipodocumento,idTipoDocumento',
            ]);

            $empresa = Empresa::findOrFail($numDocumento);
            $empresa->update($request->all());

            return response()->json(['message' => 'Empresa actualizada exitosamente.', 'data' => $empresa]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Empresa no encontrada. Detalles: ' . $e->getMessage()], 404);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al actualizar la empresa. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la empresa. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($numDocumento)
    {
        try {
            $empresa = Empresa::findOrFail($numDocumento);
            $empresa->delete();

            return response()->json(['message' => 'Empresa eliminada exitosamente.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Empresa no encontrada. Detalles: ' . $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la empresa. Detalles: ' . $e->getMessage()], 500);
        }
    }
}
