<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    //LOGIN OK
    public function login(Request $request){
        try{
            $validator = Validator::make($request->all(),[
                "email"=>"required|email",
                "password"=>"required"
            ]);
            if($validator->fails()){
                return response()->json($validator->errors(), 422);
            }
            //buscar usuario
            $user = User::where("email",$request->email)->first();
            if(!empty($user)){
                if($user->status==true){
                    if(Hash::check($request->password,$user->password)){
                        // Restablecer los intentos fallidos después de un inicio de sesión exitoso
                        $user->update(['failed_attempts' => 0]);

                        $token=$user->createToken("token")->accessToken;
                        return response()->json([
                            "status"=>true,
                            "message"=>"Login exitoso",
                            "user"=>$user,
                            "token"=>$token,
                        ]);
                    }else{
                        // Incrementar los intentos fallidos
                        $user->increment('failed_attempts');
                        // Verificar si se alcanzó el máximo de intentos fallidos permitidos
                        $maxFailedAttempts = 5; // Valor configurable
                        if ($user->failed_attempts >= $maxFailedAttempts) {
                            // Bloquear la cuenta del usuario
                            $user->update(['status' => false]);
                            return response()->json([
                                "status"=>false,
                                "message" => "Su cuenta ha sido bloqueada debido a múltiples intentos fallidos de inicio de sesión. Comuníquese con el administrador.",
                            ]);
                        }{
                            return response()->json([
                                "status"=>false,
                                "message" => "Contraseña incorrecta. Te quedan " . $maxFailedAttempts - $user->failed_attempts . " intentos antes de que tu cuenta sea bloqueada."
                            ]);
                        }
                    }
                }else{
                        return response()->json([
                            "status"=>false,
                            "message"=>"Su cuenta está inactiva, Comuníquese con el administrador",
                        ]);
                }
            }else{
                return response()->json([
                    "status"=>false,
                    "message"=>"Usuario no encontrado",
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                "status"=>false,
                "message"=>"Error al iniciar sesión",
                "error"=>$e->getMessage(),
            ]);
        }

    }
    public function register(Request $request){
        //Validación
    }
    public function logout(Request $request){
        //
    }


    /**
     * Display a listing of the resource.
     */
    public function index(){
        //
        return response()->json([
            'data'=>User::all(),
            'status'=> 200,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        //
        try{
            $data = User:: create($request->all());
            return response()->json( [
                'data' => $data,
                'status'=> 200,
            ]);
        }
        catch(\Exception $err){
            return response()->json( [
                'error' => $err->getMessage(),
                'status'=> 500,
            ]);
        }
    }

    /**
     * Display the specified resource.
     */

     //revisar si pasar un objeto(Subject $subject) o un id
    public function show($id){
        try{
            return response()->json( [
                'data'=>User::find($id),
                'status'=> 200,
            ]);
        }
        catch(\Exception $err){
            return response()->json( [
                'error' => $err->getMessage(),
                'status'=> 500,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id){
        //
        try{
            $data = User::findOrFail($id);
            $data -> update($request->all());
            return response()->json( [
                'data' => $data,
                'status'=> 200,
            ]);
        }
        catch(\Exception $err){
            return response()->json( [
                'error' => $err->getMessage(),
                'status'=> 500,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        try{
            $data = User::findOrFail($id);
            $data -> delete();
            return response()->json( [
                'data' => $id,
                'status'=> 200,
            ]);
        }
        catch(\Exception $err){
            return response()->json( [
                'error' => $err->getMessage(),
                'status'=> 500,
            ]);
        }
    }
}
/////////////////////////////////////////////////////////////7 ELIMINAR
//REGISTRO OK
// public function register(Request $request){
//     try{
//         $validator = Validator::make($request->all(),[
//             "name"=>"required|string",
//             "email"=>"required|string|email",
//             "password"=>"required|min:8"
//             //revisar tipo de dato del status
//         ]);
//         if($validator->fails()){
//             return response()->json($validator->errors(), 400);
//         }
//         // Verificar si el usuario ya existe
//         $existingUser = User::where('email', $request->email)->first();
//         if (!empty($existingUser)) {
//             return response()->json([
//                 'status' => false,
//                 'message' => 'El usuario ya existe',
//             ], 409);
//         }else{
//             $user = User::create([
//                 "name"=>$request->name,
//                 "email"=>$request->email,
//                 "password"=>bcrypt($request->password),
//                 "status"=>$request->get('status', 'active'),
//                 "role"=>$request->get('role', 'docente'),
//                 // "status"=>$request->status || 'active', //se pone numerico
//             ]);
//             return response()->json([
//                 "message"=>"Usuario Creado con éxito",
//                 "user"=> $user,
//             ], 201);
//         }
//     }catch(\Exception $e){
//         return response()->json([
//             "status"=>false,
//             "message"=>"Error al registrar usuario",
//             "error"=>$e->getMessage(),
//         ]);
//     }

// }

// //LOGOUT
// public function logout(Request $request){
//     try{
//         $request->user()->token()->revoke();
//         return response()->json([
//             "status"=>true,
//             "message"=>"Logout exitoso",
//         ]);
//     }catch(\Exception $e){
//         return response()->json([
//             "status"=>false,
//             "message"=>"Error al cerrar sesión",
//             "error"=>$e->getMessage(),
//         ]);
//     }

// }
// //USUARIO AUTENTICADO
// public function profile(Request $request){
//     try{
//         return response()->json([
//             "status"=>true,
//             "message"=>"Usuario autenticado",
//             "user"=>$request->user(),
//         ]);
//     }catch(\Exception $e){
//         return response()->json([
//             "status"=>false,
//             "message"=>"Error al obtener perfil de usuario",
//             "error"=>$e->getMessage(),
//         ]);
//     }

// }

// //ALTERNATIVAS
// public function profile2(){
//     try{
//         $userData = auth()->user();
//         return response()->json([
//             "status"=>true,
//             "message"=>"Perfil de usuario",
//             "user"=>$userData,
//             // "id" => auth()->user()->id,
//         ]);
//     }catch(\Exception $e){
//         return response()->json([
//             "status"=>false,
//             "message"=>"Error al obtener perfil de usuario",
//             "error"=>$e->getMessage(),
//         ]);
//     }

// }
// public function logout2(){
//     try{
//         $token = auth()->user()->token()->revoke();
//         return response()->json([
//             "status"=>true,
//             "message"=>"Logout exitoso",
//             "data"=>[
//                 "token"=>$token
//             ]
//         ]);
//     }catch(\Exception $e){
//         return response()->json([
//             "status"=>false,
//             "message"=>"Error al cerrar sesión",
//             "error"=>$e->getMessage(),
//         ]);
//     }

// }
