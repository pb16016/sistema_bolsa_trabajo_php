<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Certificaciones;

class CertificacionesController extends Controller
{
    public function getAll()
    {
        try {
            $certificaciones = Certificaciones::all();
            return response()->json($certificaciones);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las certificaciones. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById($idCertificacion)
    {
        try {
            $certificacion = Certificaciones::findOrFail($idCertificacion);
            return response()->json($certificacion);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Certificación no encontrada. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener la certificación. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'idCurriculum' => 'required|exists:cvs,idCurriculum',
                'tipoCertificacion' => 'required|string|max:30',
                'nombreCertificacion' => 'required|string|max:100',
                'codigoCertificacion' => 'required|string|max:50',
                'institucionOtorgante' => 'required|string|max:150',
                'fechaCertificacion' => 'required|date',
                'descripcion' => 'nullable|string|max:250',
            ]);

            $certificacion = Certificaciones::create($request->all());

            return response()->json(['message' => 'Certificación creada exitosamente.', 'data' => $certificacion], Response::HTTP_CREATED);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al crear la certificación. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la certificación. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $idCertificacion)
    {
        try {
            $request->validate([
                'idCurriculum' => 'exists:cvs,idCurriculum',
                'tipoCertificacion' => 'string|max:30',
                'nombreCertificacion' => 'string|max:100',
                'codigoCertificacion' => 'string|max:50',
                'institucionOtorgante' => 'string|max:150',
                'fechaCertificacion' => 'date',
                'descripcion' => 'nullable|string|max:250',
            ]);

            $certificacion = Certificaciones::findOrFail($idCertificacion);
            $certificacion->update($request->all());

            return response()->json(['message' => 'Certificación actualizada exitosamente.', 'data' => $certificacion]);
        
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Certificación no encontrada. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al actualizar la certificación. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la certificación. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($idCertificacion)
    {
        try {
            $certificacion = Certificaciones::findOrFail($idCertificacion);
            $certificacion->delete();

            return response()->json(['message' => 'Certificación eliminada exitosamente.']);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Certificación no encontrada. Detalles: ' . $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la certificación. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
