<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\CompetencieController;
use App\Http\Controllers\GraduateProfileController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\LearningResultController;
use App\Http\Controllers\PensumController;
use Illuminate\Support\Facades\Route;
// Route::get('/user', function (Request $request) {return $request->user();})->middleware('auth:api');

//RUTAS PUBLICAS
Route::post('/login', [ApiController::class, 'login']);
// Ruta para listar todo
Route::get('/subjects', [SubjectController::class, 'index']);
Route::get('/competencies', [CompetencieController::class, 'index']);
Route::get('/graduate-profiles', [GraduateProfileController::class, 'index']);
Route::get('/levels', [LevelController::class, 'index']);
Route::get('/programs', [ProgramController::class, 'index']);
Route::get('/pensums', [PensumController::class, 'index']);
Route::get('/learning-results', [LearningResultController::class, 'index']);
// Ruta para mostrar uno específico
Route::get('/subjects/{id}', [SubjectController::class, 'show']);
Route::get('/competencies/{id}', [CompetencieController::class, 'show']);
Route::get('/graduate-profiles/{id}', [GraduateProfileController::class, 'show']);
Route::get('/levels/{id}', [LevelController::class, 'show']);
Route::get('/programs/{id}', [ProgramController::class, 'show']);
Route::get('/pensums/{id}', [PensumController::class, 'show']);
Route::get('/learning-results/{id}', [LearningResultController::class, 'show']);

//RUTAS DE PARA USUARIOS AUTENTICADOS
//NOTA DIVIDIR POR ROLES Y PERMISOS
Route::group(["middleware" => ["auth:api", ], ], function(){
    Route::get('/profile', [ApiController::class, 'profile']);
    Route::get('/logout', [ApiController::class, 'logout']);
    // Ruta para listar todo
    Route::get('/users', [ApiController::class, 'index']);
    // Ruta para mostrar uno específico
    Route::get('/users/{id}', [ApiController::class, 'show']);
    // Ruta para crear o registrar uno nuevo
    Route::post('/users', [ApiController::class, 'store']);
    Route::post('/subjects', [SubjectController::class, 'store']);
    Route::post('/competencies', [CompetencieController::class, 'store']);
    Route::post('/graduate-profiles', [GraduateProfileController::class, 'store']);
    Route::post('/levels', [LevelController::class, 'store']);
    Route::post('/programs', [ProgramController::class, 'store']);
    Route::post('/pensums', [PensumController::class, 'store']);
    Route::post('/learning-results', [LearningResultController::class, 'store']);
    // Ruta para actualizar uno existente
    Route::put('/users/{id}', [ApiController::class, 'update']);
    Route::put('/subjects/{id}', [SubjectController::class, 'update']);
    Route::put('/competencies/{id}', [CompetencieController::class, 'update']);
    Route::put('/graduate-profiles/{id}', [GraduateProfileController::class, 'update']);
    Route::put('/levels/{id}', [LevelController::class, 'update']);
    Route::put('/programs/{id}', [ProgramController::class, 'update']);
    Route::put('/pensums/{id}', [PensumController::class, 'update']);
    Route::put('/learning-results/{id}', [LearningResultController::class, 'update']);
    // Ruta para eliminar uno
    Route::delete('/users/{id}', [ApiController::class, 'destroy']);
    Route::delete('/subjects/{id}', [SubjectController::class, 'destroy']);
    Route::delete('/competencies/{id}', [CompetencieController::class, 'destroy']);
    Route::delete('/graduate-profiles/{id}', [GraduateProfileController::class, 'destroy']);
    Route::delete('/levels/{id}', [LevelController::class, 'destroy']);
    Route::delete('/programs/{id}', [ProgramController::class, 'destroy']);
    Route::delete('/pensums/{id}', [PensumController::class, 'destroy']);
    Route::delete('/learning-results/{id}', [LearningResultController::class, 'destroy']);
});
//----------------------------------------------------------------------------------------------------------

//RUTAS PROTEGIDAS + "prefix" => "users"
Route::group(["middleware" => ["auth:api"], ], function(){

});
//RUTAS DE PARA USUARIOS AUTENTICADOS + ROLES Y PERMISOS
Route::middleware('auth:api')->group(function () {

});

// Route::group(["middleware" => ["auth:api"], ], function(){

// });
