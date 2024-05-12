<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Route::get('/user', function (Request $request) {return $request->user();})->middleware('auth:api');

//RUTAS PUBLICAS
//Route::get('/index', [ApiController::class, 'index']);
Route::post('/login', [ApiController::class, 'login']);

//RUTAS DE PARA USUARIOS AUTENTICADOS
//RUTAS PROTEGIDAS, "prefix" => "users"
Route::group(["middleware" => ["auth:api"], ], function(){

});
//RUTAS DE PARA USUARIOS AUTENTICADOS + ROLES Y PERMISOS
Route::middleware('auth:api')->group(function () {

});


// Route::group(["middleware" => ["auth:api"], ], function(){
//     Route::get('/profile', [ApiController::class, 'profile']);
//     Route::get('/logout', [ApiController::class, 'logout']);
//     Route::post('/register', [ApiController::class, 'register']);

// });


