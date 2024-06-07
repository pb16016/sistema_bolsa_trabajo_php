<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\RoleUser;

class RoleUserController extends Controller
{
    public function getAll()
    {
        try {
            $roles = RoleUser::all();
            return response()->json($roles, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las relaciones de roles'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById($idRol)
    {
        try {
            $role = RoleUser::findOrFail($idRol);
            return response()->json($role, Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Relación de rol no encontrado'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener el rol'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'role_id' => 'required|exists:roles,id',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $role = RoleUser::create($request->all());
            return response()->json(['message' => 'Relación de rol creado exitosamente.', 'data' => $role], Response::HTTP_CREATED);
       
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al crear la relación de role y user. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el rol'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $idRol)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'role_id' => 'required|exists:roles,id',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $role = RoleUser::findOrFail($idRol);
            $role->update($request->all());
            return response()->json(['message' => 'Relación de rol actualizado exitosamente.', 'data' => $role], Response::HTTP_OK);
        
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al crear la relación de role y user. Detalles: ' . $e->errors()], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Relación de rol no encontrado'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el rol'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($idRol)
    {
        try {
            $role = RoleUser::findOrFail($idRol);
            $role->delete();
            return response()->json(['message' => 'Relación de rol eliminado exitosamente'], Response::HTTP_OK);
        
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Rol no encontrado'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el rol'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
