<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Cargos;
use App\Models\ExperienciaRequerida;

class CargosController extends Controller
{
    public function getAll()
    {
        try {
            $cargos = Cargos::all();
            return response()->json($cargos);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los cargos. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById($idCargo)
    {
        try {
            $cargo = Cargos::findOrFail($idCargo);
            return response()->json($cargo);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Cargo no encontrado. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al buscar el cargo. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getOfertasTrabajoByProfesion()
    {
        try {
            $idProfesion = request('idProfesion');
            $cargos = Cargos::where('idProfesion', $idProfesion)->get();

            if ($cargos && !is_null($cargos)) {
                $ofertas = [];
                foreach ($cargos as $cargo) {
                    $idCargo = $cargo->idCargo;

                    $expsRequeridas = ExperienciaRequerida::where('idCargo', $idCargo)->get();
            
                    foreach ($expsRequeridas as $expRequerida) {
                        $ofertasTrabajo = $expRequerida->perfilPuestoTrabajo->ofertasTrabajo;
                        
                        foreach ($ofertasTrabajo as $ofertaTrabajo) {
                            $ofertas[] = $ofertaTrabajo;
                            $experienciasReq = $ofertaTrabajo->perfilPuesto->experienciasRequeridas;
                            $ofertaTrabajo->estadoOferta;

                            foreach ($experienciasReq as $experienciaReq) {
                                $experienciaReq->cargo;
                            }
                        }
                    }
                }

                return response()->json($ofertas);
            } else {
                return response()->json(['message' => 'Profesion no encontrada para los cargos relacionados.']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al buscar ofertas de trabajo por profesion. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombreCargo' => 'required|max:50',
                'idProfesion' => 'required|exists:profesiones,idProfesion',
                'descripcion' => 'nullable|string|max:250',
            ]);

            $cargo = Cargos::create($request->all());

            return response()->json(['message' => 'Cargo creado exitosamente.', 'data' => $cargo], Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error al crear el cargo. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $idCargo)
    {
        try {
            $request->validate([
                'nombreCargo' => 'required|max:50',
                'idProfesion' => 'required|exists:profesiones,idProfesion',
                'descripcion' => 'nullable|string|max:250',
            ]);

            $cargo = Cargos::findOrFail($idCargo);
            $cargo->update($request->all());

            return response()->json(['message' => 'Cargo actualizado exitosamente.', 'data' => $cargo]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Cargo no encontrado. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el cargo. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($idCargo)
    {
        try {
            $cargo = Cargos::findOrFail($idCargo);
            $cargo->delete();

            return response()->json(['message' => 'Cargo eliminado exitosamente.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Cargo no encontrado. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el cargo. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}