<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "email" => "required|email",
                "password" => "required"
            ]);

            $user = User::where("email", $request->email)->first();

            if (!empty($user)) {
                if ($user->status == true) {
                    if (Hash::check($request->password, $user->password)) {
                        $user->update(['failed_attempts' => 0]);
                        $token = $user->createToken("token")->accessToken;
                        return response()->json([
                            "message" => "Login exitoso.",
                            "user" => $user,
                            "token" => $token,
                            "token_type" => "Bearer",
                            "expires_at" => now()->addHours(1),
                        ], 200);
                    } else {
                        $this->handleFailedLogin($user);
                        return $this->sendFailedLoginResponse($user);
                    }
                } else {
                    return response()->json([
                        "message" => "Su cuenta está inactiva, Comuníquese con el administrador.",
                    ], 403);
                }
            } else {
                return response()->json([
                    "message" => "Usuario no encontrado.",
                ], 401);
            }
        } catch (\Exception $err) {
            return response()->json([
                "message" => $err->getMessage(),
                "error" => "Ha ocurrido un error inesperado. Por favor, inténtalo nuevamente más tarde.",
            ], 500);
        }
    }

    public function profile(Request $request)
    {
        try {
            return response()->json([
                "message" => "Perfil de usuario.",
                "user" => $request->user(),
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                "message" => $err->getMessage(),
                "error" => "Error al obtener perfil de usuario.",
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->token()->revoke();
            return response()->json([
                "message" => "Logout exitoso",
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                "message" => $err->getMessage(),
                "error" => "Error al cerrar sesión",
            ], 500);
        }
    }

    public function index()
    {
        try {
            // $users = User::paginate(10);// Usar paginación en lugar de cargar todos los usuarios
            $users = User::all();
            return response()->json([
                'users' => $users,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Error al obtener los usuarios.',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "name" => "required|string|max:255",
                "email" => "required|string|email|unique:users",
                "password" => "required|min:8",
                'status' => 'nullable|boolean',
                "role" => "required|string|in:1,user,2,docente,3,coordinador,4,admin,5,super-admin",
            ]);

            $validatedData['password'] = bcrypt($validatedData['password']);

            $user = User::create($validatedData);

            return response()->json([
                'message' => 'Usuario creado con éxito.',
                'user' => $user,
            ], 201);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Ha ocurrido un error inesperado. Por favor, inténtalo nuevamente más tarde.',
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json([
                'user' => $user,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Usuario no encontrado.',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $validatedData = $request->validate([
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|email|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8',
                'role' => 'nullable|in:1,user,2,docente,3,coordinador,4,admin,5,super-admin',
                'status' => 'nullable|boolean',
            ]);

            if ($request->filled('password')) {
                $validatedData['password'] = bcrypt($validatedData['password']);
            }

            $user->update($validatedData);

            return response()->json([
                'message' => 'Usuario actualizado exitosamente.',
                'user' => $user,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'No se pudo actualizar el usuario.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update(['status' => false]);
            return response()->json([
                'message' => 'El usuario ha pasado a estar inactivo.',
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Error al inactivar el usuario.',
            ], 500);
        }
    }

    // Métodos adicionales

    protected function handleFailedLogin($user)
    {
        $user->increment('failed_attempts');
        $maxFailedAttempts = 5;

        if ($user->failed_attempts >= $maxFailedAttempts) {
            $user->update(['status' => false]);
        }
    }

    protected function sendFailedLoginResponse($user)
    {
        $maxFailedAttempts = 5;

        if ($user->failed_attempts >= $maxFailedAttempts) {
            return response()->json([
                "message" => "Su cuenta ha sido bloqueada debido a múltiples intentos fallidos de inicio de sesión. Comuníquese con el administrador.",
            ], 429);
        }

        return response()->json([
            "message" => "Contraseña incorrecta. Te quedan " . ($maxFailedAttempts - $user->failed_attempts) . " intentos antes de que tu cuenta sea bloqueada."
        ], 401);
    }
}
