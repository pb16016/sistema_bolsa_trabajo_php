<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CVs;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CVsController extends Controller
{
    public function getAll()
    {
        try {
            $cvs = CVs::all();
            return response()->json($cvs);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los CVs. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById()
    {
        try {
            $idCurriculum = request('idCurriculum');
            $cv = CVs::findOrFail($idCurriculum);
            return response()->json($cv);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'CV no encontrado. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al buscar el CV. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getSolicitudesCVsByNumDoc()
    {
        try {
            $numDocumento = request('numDocumento');
            $cvs = CVs::where('numDocumento', 'like', '%'.$numDocumento.'%')->get();
            
            foreach ($cvs as $cv) {
                $solicitudesAspirante = $cv->solicitudesCv;
                foreach ($solicitudesAspirante as $solicitudAspirante) {
                    $solicitudAspirante->ofertaTrabajo->estadoOferta;
                    $solicitudAspirante->ofertaTrabajo->perfilPuesto;
                    $solicitudAspirante->estadoSolicitud;
                }
            }
            return response()->json($cvs);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Solicitudes no encontradas por el número de documento. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al buscar las solicitudes por el número de documento. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'numDocumento' => 'required|exists:persona,numDocumento',
                'fechaPublicacion' => 'required|date',
                'descripcion' => 'nullable|string',
            ]);

            $cv = CVs::create($request->all());
            return response()->json(['message' => 'CV creado exitosamente.', 'data' => $cv], Response::HTTP_CREATED);

        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al crear el CV. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el CV. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $idCurriculum)
    {
        try {
            $request->validate([
                'numDocumento' => 'required|exists:persona,numDocumento',
                'fechaPublicacion' => 'required|date',
                'descripcion' => 'nullable|string',
            ]);

            $cv = CVs::findOrFail($idCurriculum);
            $cv->update($request->all());
            return response()->json(['message' => 'CV actualizado exitosamente.', 'data' => $cv]);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'CV no encontrado. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al actualizar el CV. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el CV. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($idCurriculum)
    {
        try {
            $cv = CVs::findOrFail($idCurriculum);
            $cv->delete();
            return response()->json(['message' => 'CV eliminado exitosamente.']);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'CV no encontrado. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el CV. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
