<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        try {
            $levels = Level::paginate(10);
            return response()->json([
                'levels' => $levels,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'No se pudieron obtener los niveles.',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "verb" => "required|string|unique:levels,verb",
                "taxonomy_level" => "required|in:1,recordar, 2,entender,3,aplicar,4,analizar,5, evaluar,6,crear",
            ]);

            $level = Level::create($validatedData);

            return response()->json([
                'message' => 'Nivel creado con éxito.',
                'level' => $level,
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
            $level = Level::findOrFail($id);
            return response()->json([
                'level' => $level,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Nivel no encontrado.',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $level = Level::findOrFail($id);
            $validatedData = $request->validate([
                'verb' => 'nullable|string|unique:levels,verb,' .$level->id,
                'taxonomy_level' => 'nullable|in:1,recordar,2,entender,3,aplicar,4,analizar,5,evaluar,6,crear',
            ]);

            $level->update($validatedData);

            return response()->json([
                'message' => 'Nivel actualizado exitosamente.',
                'level' => $level,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Error al actualizar el nivel.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $level = Level::findOrFail($id);
            $level->delete();
            return response()->json([
                'message' => 'El nivel ha sido eliminado.',
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Error al eliminar el nivel.',
            ], 500);
        }
    }
}
