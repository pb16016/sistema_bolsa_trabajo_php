<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\RolesUsuario;

class RolesUsuarioController extends Controller
{
    public function getAll()
    {
        try {
            $roles = RolesUsuario::all();
            return response()->json($roles, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los roles'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById($idRol)
    {
        try {
            $role = RolesUsuario::findOrFail($idRol);
            return response()->json($role, Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Rol no encontrado'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener el rol'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nombreRol' => 'required|string|max:25',
                'descripcionRol' => 'nullable|string|max:250',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $role = RolesUsuario::create($request->all());
            return response()->json(['message' => 'Rol creado exitosamente.', 'data' => $role], Response::HTTP_CREATED);
       
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el rol'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $idRol)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nombreRol' => 'required|string|max:25',
                'descripcionRol' => 'nullable|string|max:250',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $role = RolesUsuario::findOrFail($idRol);
            $role->update($request->all());
            return response()->json(['message' => 'Rol actualizado exitosamente.', 'data' => $role], Response::HTTP_OK);
        
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Rol no encontrado'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el rol'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($idRol)
    {
        try {
            $role = RolesUsuario::findOrFail($idRol);
            $role->delete();
            return response()->json(['message' => 'Rol eliminado exitosamente'], Response::HTTP_OK);
        
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Rol no encontrado'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el rol'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
