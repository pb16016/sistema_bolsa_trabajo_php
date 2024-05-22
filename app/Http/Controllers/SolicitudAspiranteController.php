<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\SolicitudAspirante;

class SolicitudAspiranteController extends Controller
{
    public function getAll()
    {
        try {
            $solicitudes = SolicitudAspirante::all();
            return response()->json($solicitudes);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las solicitudes. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findByIds($idCurriculum, $idOfertaLaboral)
    {
        try {
            $solicitud = SolicitudAspirante::where('idCurriculum', $idCurriculum)
                ->where('idOfertaLaboral', $idOfertaLaboral)
                ->firstOrFail();

            return response()->json($solicitud);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener la solicitud. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'idCurriculum' => 'required|exists:cvs,idCurriculum',
                'idOfertaLaboral' => 'required|exists:ofertatrabajo,idOfertaLaboral',
                'idEstadoSolicitud' => 'required|exists:estados,idEstado',
                'fechaSolicitud' => 'required|date',
            ]);

            $solicitud = SolicitudAspirante::create($request->all());
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
