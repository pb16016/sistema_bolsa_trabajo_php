<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\EstadoUsuario;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'description' => 'sometimes|string|nullable',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:15',
                'confirmed',
                'regex:/^[a-zA-Z]/', // Debe comenzar con una letra
                'regex:/[A-Z]/',     // Debe contener al menos una letra mayúscula
                'regex:/[@$!%*?&#]/', // Debe contener al menos un símbolo especial
                'regex:/[0-9]/'     // Debe contener al menos un número
            ],
            'password_confirmation' => [
                'required',
                'string',
                'min:8',
                'max:15',
                'regex:/^[a-zA-Z]/', // Debe comenzar con una letra
                'regex:/[A-Z]/',     // Debe contener al menos una letra mayúscula
                'regex:/[@$!%*?&#]/', // Debe contener al menos un símbolo especial
                'regex:/[0-9]/',     // Debe contener al menos un número
                'same:password'
            ],
        ], [
            'password_confirmation.same' => 'The password confirmation does not match.',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        // Obtenemos el ID del estado "Activo"
        $idEstadoActivo = EstadoUsuario::where('estadoUsuario', 'Activo')->value('idEstadoUsuario');

        // Crear el usuario con la contraseña cifrada
        try {
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Cifrar la contraseña
                'state_user_id' => $idEstadoActivo,
                'failed_attempts' => 0,
                'description' => $request->description,
            ]);

            return response()->json(['message' => 'Usuario registrado exitosamente', 'data' => $user], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al registrar el usuario'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'username' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id,
                'description' => 'sometimes|string|nullable',
                'state_user_id' => 'sometimes|exists:estado_usuarios,id',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            // Actualizar los campos del usuario
            if ($request->has('username')) {
                $user->username = $request->username;
            }

            if ($request->has('email')) {
                $user->email = $request->email;
            }

            if ($request->has('description')) {
                $user->description = $request->description;
            }

            if ($request->has('state_user_id')) {
                $user->state_user_id = $request->state_user_id;
            }

            $user->save();

            return response()->json(['message' => 'Usuario actualizado exitosamente', 'data' => $user], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuario no encontrado.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el usuario. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Método para dar de baja a un usuario
    public function deactivate($id)
    {
        return $this->changeUserState($id, 'Inactivo');
    }

    // Método para activar a un usuario
    public function activate($id)
    {
        return $this->changeUserState($id, 'Activo');
    }

     // Método para suspender a un usuario
     public function suspend($id)
     {
         return $this->changeUserState($id, 'Suspendido');
     }

    // Método para bloquear a un usuario
    public function block($id)
    {
        return $this->changeUserState($id, 'Bloqueado');
    }

    // Método para manejar el cambio de estado de un usuario
    private function changeUserState($id, $estado)
    {
        try {
            $user = User::findOrFail($id);

            $estadoUsuario = EstadoUsuario::where('estadoUsuario', $estado)->firstOrFail();
            $user->state_user_id = $estadoUsuario->idEstadoUsuario;
            $user->save();

            return response()->json(['message' => "Usuario $estado exitosamente"], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuario o estado no encontrado.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al cambiar el estado del usuario. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            #'username' => 'required|string',
            'login' => 'required|string', // Puede ser email o username
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        try {
            // Buscar el usuario por email o username
            $loginField = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            $user = User::where($loginField, $request->login)->firstOrFail();
            
            if (!$user) {
                throw new ModelNotFoundException("Usuario no encontrado por el username o email ingresado, debe verificarse.");
            }

            $credentials = [
                $loginField => $request->input('login'),
                'password' => $request->input('password'),
            ];
            
            if (Auth::attempt($credentials)) {
                
                $estadoUsuario = EstadoUsuario::find($user->state_user_id);
                if ($estadoUsuario->estadoUsuario != 'Activo') {
                    return response()->json(['error' => "El usuario está en estado $estadoUsuario->estadoUsuario y no puede acceder al sistema."], Response::HTTP_FORBIDDEN);
                }

                Auth::login($user);

                // Restablecer intentos fallidos en caso de éxito
                #return response()->json(['message' => 'error'], Response::HTTP_OK);
                $user->failed_attempts = 0;
                $user->save();

                return response()->json(['message' => 'Inicio de sesión exitoso', 'data' => ['email' => $user->email]], Response::HTTP_OK);
            } else {
                // Incrementar intentos fallidos
                $user->failed_attempts += 1;

                if ($user->failed_attempts >= 3) {
                    // Bloquear el usuario si los intentos fallidos son 3 o más
                    $estadoBloqueado = EstadoUsuario::where('estadoUsuario', 'Bloqueado')->first();
                    $user->state_user_id = $estadoBloqueado->idEstadoUsuario;
                }

                $user->save();

                return response()->json(['error' => 'Credenciales incorrectas.'], Response::HTTP_UNAUTHORIZED);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuario no encontrado.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al iniciar sesión. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Cierre de sesión exitoso'], Response::HTTP_OK);
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Generar una contraseña temporal
        $temporaryPassword = Str::random(10);

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($temporaryPassword);
        $user->save();

        // Enviar el correo con la contraseña temporal
        Mail::raw("Your temporary password is: $temporaryPassword Se recomienda cambiar la contraseña al ingresar de nuevo, en configuración del usuario. También podria seguir el siguiente enlace: https://bdd-frontend.web.app/change-password", function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Password Reset for the "Bolsa de trabajo" system');
        });

        return response()->json(['message' => 'A temporary password has been sent to your email address.'], Response::HTTP_OK);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string',
            'current_password' => 'required|string',
            'new_password' => [
                'required',
                'string',
                'min:8',
                'max:15',
                'confirmed',
                'regex:/^[a-zA-Z]/', // Debe comenzar con una letra
                'regex:/[A-Z]/',     // Debe contener al menos una letra mayúscula
                'regex:/[@$!%*?&#]/', // Debe contener al menos un símbolo especial
                'regex:/[0-9]/'     // Debe contener al menos un número
            ],
            'new_password_confirmation' => [
                'required',
                'string',
                'min:8',
                'max:15',
                'regex:/^[a-zA-Z]/', // Debe comenzar con una letra
                'regex:/[A-Z]/',     // Debe contener al menos una letra mayúscula
                'regex:/[@$!%*?&#]/', // Debe contener al menos un símbolo especial
                'regex:/[0-9]/',     // Debe contener al menos un número
                'same:new_password'
            ],
        ], [
            'new_password_confirmation.same' => 'The password confirmation does not match.',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        try {
            // Buscar el usuario por email o username
            $loginField = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            $user = User::where($loginField, $request->login)->firstOrFail();
            
            if (!$user) {
                throw new ModelNotFoundException("Usuario no encontrado por el username o email ingresado, debe verificarse.");
            }

            $credentials = [
                $loginField => $request->input('login'),
                'password' => $request->input('current_password'),
            ];
            
            if (Auth::attempt($credentials)) {

                if ($request->has('new_password')) {
                    $user->password = Hash::make($request->new_password);
                }
                $user->save();
                return response()->json(['message' => 'Cambio de password exitoso'], Response::HTTP_OK);

            } else {

                return response()->json(['error' => 'Credenciales actuales incorrectas.'], Response::HTTP_UNAUTHORIZED);
            }

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuario no encontrado.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al verificar y actualizar password. Detalles: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}