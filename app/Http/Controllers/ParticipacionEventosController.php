<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParticipacionEventos;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ParticipacionEventosController extends Controller
{
    public function getAll()
    {
        try {
            $eventos = ParticipacionEventos::all();
            return response()->json($eventos, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los eventos'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById($idEvento)
    {
        try {
            $evento = ParticipacionEventos::findOrFail($idEvento);
            return response()->json($evento, Response::HTTP_OK);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Evento no encontrado'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener el evento'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idCurriculum' => 'required|exists:cvs,idCurriculum',
            'nombreEvento' => 'required|string|max:100',
            'tipoEvento' => 'required|string|max:30',
            'lugarEvento' => 'required|string|max:200',
            'anfitrionEvento' => 'required|string|max:100',
            'paisEvento' => 'nullable|string|max:25',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
            'descripcion' => 'nullable|string|max:250',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        try {
            $evento = ParticipacionEventos::create($request->all());
            return response()->json(['message' => 'Participación Evento creada exitosamente.', 'data' => $evento], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el evento'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $idEvento)
    {
        $validator = Validator::make($request->all(), [
            'idCurriculum' => 'required|exists:cvs,idCurriculum',
            'nombreEvento' => 'required|string|max:100',
            'tipoEvento' => 'required|string|max:30',
            'lugarEvento' => 'required|string|max:200',
            'anfitrionEvento' => 'required|string|max:100',
            'paisEvento' => 'nullable|string|max:25',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
            'descripcion' => 'nullable|string|max:250',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        try {
            $evento = ParticipacionEventos::findOrFail($idEvento);
            $evento->update($request->all());
            return response()->json(['message' => 'Participación Evento actualizada exitosamente.', 'data' => $evento], Response::HTTP_OK);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Evento no encontrado'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el evento'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($idEvento)
    {
        try {
            $evento = ParticipacionEventos::findOrFail($idEvento);
            $evento->delete();
            return response()->json(['message' => 'Evento eliminado exitosamente'], Response::HTTP_OK);
        
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Evento no encontrado'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el evento'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}