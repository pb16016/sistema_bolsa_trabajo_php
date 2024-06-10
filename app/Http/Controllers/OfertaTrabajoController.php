<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\OfertaTrabajo;
use App\Models\Estados;

class OfertaTrabajoController extends Controller
{
    public function getAll()
    {
        try {
            #$ofertas = OfertaTrabajo::all();

            // Obtenemos los IDs de los estados "Cerrado" y "Suspendido"
            $idEstadoCerrado = Estados::where('nombreEstado', 'Cerrado')->value('idEstado');
            $idEstadoInactivo = Estados::where('nombreEstado', 'Inactivo')->value('idEstado');

            $ofertas = OfertaTrabajo::where('idEstadoOferta', '!=', $idEstadoCerrado)
                                    ->where('idEstadoOferta', '!=', $idEstadoInactivo)
                                    ->with('perfilPuesto')
                                    ->get();

            return response()->json($ofertas);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las ofertas de trabajo. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById()
    {
        try {
            $idOfertaLaboral = request('idOfertaLaboral');

            // Obtenemos los IDs de los estados "Cerrado" y "Suspendido"
            $idEstadoCerrado = Estados::where('nombreEstado', 'Cerrado')->value('idEstado');
            $idEstadoInactivo = Estados::where('nombreEstado', 'Inactivo')->value('idEstado');

            $oferta = OfertaTrabajo::where('idOfertaLaboral', $idOfertaLaboral)
                                    ->where(function ($query) use ($idEstadoCerrado, $idEstadoInactivo) {
                                        $query->where('idEstadoOferta', '!=', $idEstadoCerrado)
                                            ->where('idEstadoOferta', '!=', $idEstadoInactivo);
                                    })
                                    ->firstOrFail();
            $oferta->estadoOferta;
            $expRequeridas = $oferta->perfilPuesto->experienciasRequeridas;

            foreach ($expRequeridas as $expRequerida) {
                $expRequerida->cargo;
            }

            $solicitudesAspirante = $oferta->solicitudesAspirante;

            foreach ($solicitudesAspirante as $solicitudAspirante) {
                $solicitudAspirante->estadoSolicitud;
                $solicitudAspirante->cv;
            }

            return response()->json($oferta);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Oferta de trabajo no encontrada por los datos ingresados, o no se encuentra activa. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al buscar la oferta de trabajo. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                #'idEstadoOferta' => 'required|exists:estados,idEstado',
                'idPerfilPuesto' => 'required|exists:perfilpuestotrabajo,idPerfilPuesto',
                'fechaPublicacion' => 'required|date',
                'fechaCierre' => 'required|date|after:fechaPublicacion',
                'descripcion' => 'nullable|string',
            ]);
            // Obtenemos el ID del estado "Activo"
            $idEstadoActivo = Estados::where('nombreEstado', 'Activo')->value('idEstado');
            
            // Creamos la oferta de trabajo y establecemos el estado como "Activo"
            $oferta = OfertaTrabajo::create(array_merge($request->all(), ['idEstadoOferta' => $idEstadoActivo]));

            #$oferta = OfertaTrabajo::create($request->all());
            return response()->json(['message' => 'Oferta de trabajo creada exitosamente.', 'data' => $oferta], Response::HTTP_CREATED);

        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al crear la oferta de trabajo. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la oferta de trabajo. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $idOfertaLaboral)
    {
        try {
            $request->validate([
                'idEstadoOferta' => 'required|exists:estados,idEstado',
                'idPerfilPuesto' => 'required|exists:perfilpuestotrabajo,idPerfilPuesto',
                'fechaPublicacion' => 'required|date',
                'fechaCierre' => 'required|date|after:fechaPublicacion',
                'descripcion' => 'nullable|string',
            ]);

            $oferta = OfertaTrabajo::findOrFail($idOfertaLaboral);
            $oferta->update($request->all());
            return response()->json(['message' => 'Oferta de trabajo actualizada exitosamente.', 'data' => $oferta]);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Oferta de trabajo no encontrada. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al actualizar la oferta de trabajo. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la oferta de trabajo. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($idOfertaLaboral)
    {
        try {
            $oferta = OfertaTrabajo::findOrFail($idOfertaLaboral);
            $oferta->delete();
            return response()->json(['message' => 'Oferta de trabajo eliminada exitosamente.']);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Oferta de trabajo no encontrada. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la oferta de trabajo. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}