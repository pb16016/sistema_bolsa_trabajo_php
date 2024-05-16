<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfertaTrabajo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class OfertaTrabajoController extends Controller
{
    public function getAll()
    {
        try {
            $ofertas = OfertaTrabajo::all();
            return response()->json($ofertas);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las ofertas de trabajo. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function findById()
    {
        try {
            $idOfertaLaboral = request('idOfertaLaboral');
            $oferta = OfertaTrabajo::findOrFail($idOfertaLaboral);
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
            return response()->json(['error' => 'Oferta de trabajo no encontrada. Detalles: ' . $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al buscar la oferta de trabajo. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'idEstadoOferta' => 'required|exists:estados,idEstado',
                'idPerfilPuesto' => 'required|exists:perfilpuestotrabajo,idPerfilPuesto',
                'fechaPublicacion' => 'required|date',
                'fechaCierre' => 'required|date',
                'descripcion' => 'nullable|string',
            ]);

            $oferta = OfertaTrabajo::create($request->all());
            return response()->json(['message' => 'Oferta de trabajo creada exitosamente.', 'data' => $oferta], 201);

        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al crear la oferta de trabajo. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la oferta de trabajo. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $idOfertaLaboral)
    {
        try {
            $request->validate([
                'idEstadoOferta' => 'required|exists:estados,idEstado',
                'idPerfilPuesto' => 'required|exists:perfilpuestotrabajo,idPerfilPuesto',
                'fechaPublicacion' => 'required|date',
                'fechaCierre' => 'required|date',
                'descripcion' => 'nullable|string',
            ]);

            $oferta = OfertaTrabajo::findOrFail($idOfertaLaboral);
            $oferta->update($request->all());
            return response()->json(['message' => 'Oferta de trabajo actualizada exitosamente.', 'data' => $oferta]);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Oferta de trabajo no encontrada. Detalles: ' . $e->getMessage()], 404);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al actualizar la oferta de trabajo. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la oferta de trabajo. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($idOfertaLaboral)
    {
        try {
            $oferta = OfertaTrabajo::findOrFail($idOfertaLaboral);
            $oferta->delete();
            return response()->json(['message' => 'Oferta de trabajo eliminada exitosamente.']);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Oferta de trabajo no encontrada. Detalles: ' . $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la oferta de trabajo. Detalles: ' . $e->getMessage()], 500);
        }
    }
}