<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArticulosLibros;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ArticulosLibrosController extends Controller
{
    public function getAll()
    {
        try {
            $articulosLibros = ArticulosLibros::all();
            return response()->json($articulosLibros, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los artículos y libros'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById($idArticuloLibro)
    {
        try {
            $articuloLibro = ArticulosLibros::findOrFail($idArticuloLibro);
            return response()->json($articuloLibro, Response::HTTP_OK);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Artículo o libro no encontrado'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener el artículo o libro'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idCurriculum' => 'required|exists:cvs,idCurriculum',
            'tituloPublicacion' => 'required|string|max:250',
            'lugarPublicacion' => 'required|string|max:200',
            'tipoPublicacion' => 'required|in:Libro,Artículo',
            'fechaPublicacion' => 'required|date',
            'edicion' => 'nullable|string|max:45',
            'ISBN' => 'nullable|string|max:30',
            'descripcion' => 'nullable|string|max:250',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        try {
            $articuloLibro = ArticulosLibros::create($request->all());
            return response()->json(['message' => 'Articulo o libro creado exitosamente.', 'data' =>$articuloLibro], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el artículo o libro'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $idArticuloLibro)
    {
        $validator = Validator::make($request->all(), [
            'idCurriculum' => 'required|exists:cvs,idCurriculum',
            'tituloPublicacion' => 'required|string|max:250',
            'lugarPublicacion' => 'required|string|max:200',
            'tipoPublicacion' => 'required|in:Libro,Artículo',
            'fechaPublicacion' => 'required|date',
            'edicion' => 'nullable|string|max:45',
            'ISBN' => 'nullable|string|max:30',
            'descripcion' => 'nullable|string|max:250',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        try {
            $articuloLibro = ArticulosLibros::findOrFail($idArticuloLibro);
            $articuloLibro->update($request->all());
            return response()->json(['message' => 'Articulo o libro actualizado exitosamente.', 'data' =>$articuloLibro], Response::HTTP_OK);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Artículo o libro no encontrado'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el artículo o libro'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($idArticuloLibro)
    {
        try {
            $articuloLibro = ArticulosLibros::findOrFail($idArticuloLibro);
            $articuloLibro->delete();
            return response()->json(['message' => 'Artículo o libro eliminado exitosamente'], Response::HTTP_OK);
        
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Artículo o libro no encontrado'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el artículo o libro'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}