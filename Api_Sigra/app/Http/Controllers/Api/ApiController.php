<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        echo "Bienvenidos al Api";
    }
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
