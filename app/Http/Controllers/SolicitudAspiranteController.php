<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\SolicitudAspirante;
use App\Models\Estados;

class SolicitudAspiranteController extends Controller
{
    public function getAll()
    {
        try {
            #$solicitudes = SolicitudAspirante::all();

            // Obtenemos los IDs de los estados "Cerrado" y "Suspendido"
            $idEstadoCerrado = Estados::where('nombreEstado', 'Cerrado')->value('idEstado');
            $idEstadoSuspendido = Estados::where('nombreEstado', 'Suspendido')->value('idEstado');

            // Filtramos las solicitudes que no tengan esos estados
            $solicitudes = SolicitudAspirante::where('idEstadoSolicitud', '!=', $idEstadoCerrado)
                                            ->where('idEstadoSolicitud', '!=', $idEstadoSuspendido)
                                            ->get();

            return response()->json($solicitudes);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las solicitudes. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findByIds($idCurriculum, $idOfertaLaboral)
    {
        try {
            // Obtenemos los IDs de los estados "Cerrado" y "Suspendido"
            $idEstadoCerrado = Estados::where('nombreEstado', 'Cerrado')->value('idEstado');
            $idEstadoSuspendido = Estados::where('nombreEstado', 'Suspendido')->value('idEstado');

            $solicitud = SolicitudAspirante::where('idCurriculum', $idCurriculum)
                ->where('idOfertaLaboral', $idOfertaLaboral)
                ->where(function ($query) use ($idEstadoCerrado, $idEstadoSuspendido) {
                    $query->where('idEstadoSolicitud', '!=', $idEstadoCerrado)
                          ->where('idEstadoSolicitud', '!=', $idEstadoSuspendido);
                })
                ->firstOrFail();
            if ($solicitud){
                return response()->json($solicitud);
            } else {
                return response()->json(['error' => 'Error al buscar la solicitud por los ids proporcionados, o no se encuentra activa.'], Response::HTTP_NOT_FOUND);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener la solicitud por los ids proporcionados, o no se encuentra activa. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'idCurriculum' => 'required|exists:cvs,idCurriculum',
                'idOfertaLaboral' => 'required|exists:ofertatrabajo,idOfertaLaboral',
                #'idEstadoSolicitud' => 'required|exists:estados,idEstado',
                'fechaSolicitud' => 'required|date',
            ]);
            // Obtenemos el ID del estado "Solicitado"
            $idEstadoActivo = Estados::where('nombreEstado', 'Solicitado')->value('idEstado');
            
            // Creamos la SolicitudAspirante y establecemos el estado como "Solicitado"
            $solicitud = SolicitudAspirante::create(array_merge($request->all(), ['idEstadoSolicitud' => $idEstadoActivo]));

            #$solicitud = SolicitudAspirante::create($request->all());
            return response()->json(['message' => 'Solicitud creada exitosamente.', 'data' => $solicitud], Response::HTTP_CREATED);

        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al crear la solicitud. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la solicitud. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $idCurriculum, $idOfertaLaboral)
    {
        try {
            $request->validate([
                'idCurriculum' => 'required|exists:cvs,idCurriculum',
                'idOfertaLaboral' => 'required|exists:ofertatrabajo,idOfertaLaboral',
                'idEstadoSolicitud' => 'required|exists:estados,idEstado',
                'fechaSolicitud' => 'required|date',
            ]);

            $solicitud = SolicitudAspirante::where('idCurriculum', $idCurriculum)
                ->where('idOfertaLaboral', $idOfertaLaboral)
                ->firstOrFail();

            $solicitud->update($request->all());
            return response()->json(['message' => 'Solicitud actualizada exitosamente.', 'data' => $solicitud]);

        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al actualizar la solicitud. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la solicitud. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($idCurriculum, $idOfertaLaboral)
    {
        try {
            $solicitud = SolicitudAspirante::where('idCurriculum', $idCurriculum)
                ->where('idOfertaLaboral', $idOfertaLaboral)
                ->firstOrFail();

            $solicitud->delete();
            return response()->json(['message' => 'Solicitud eliminada exitosamente.']);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la solicitud. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
