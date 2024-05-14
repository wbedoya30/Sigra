<?php

namespace App\Http\Controllers;

use App\Models\LearningResult;
use Illuminate\Http\Request;

class LearningResultController extends Controller
{
    public function index()
    {
        try {
            $learningResults = LearningResult::paginate(10);
            return response()->json([
                'learning_results' => $learningResults,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'No se pudieron obtener los resultados de aprendizaje.',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "definition" => "required|string|unique:learning_results,definition",
                "subject_id" => "required|exists:subjects,id",
                "level_id" => "required|exists:levels,id",
                //manejo de unico para 2 campos
            ]);

            $learningResult = LearningResult::create($validatedData);

            return response()->json([
                'message' => 'Resultado de aprendizaje creado con éxito.',
                'learning_result' => $learningResult,
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
            $learningResult = LearningResult::findOrFail($id);
            return response()->json([
                'learning_result' => $learningResult,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Resultado de aprendizaje no encontrado.',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $learningResult = LearningResult::findOrFail($id);
            $validatedData = $request->validate([
                'definition' => 'nullable|string|unique:learning_results,definition' .$learningResult->id,
                'subject_id' => 'nullable|exists:subjects,id',
                'level_id' => 'nullable|exists:levels,id',
            ]);

            $learningResult->update($validatedData);

            return response()->json([
                'message' => 'Resultado de aprendizaje actualizado exitosamente.',
                'learning_result' => $learningResult,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Error al actualizar el resultado de aprendizaje.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $learningResult = LearningResult::findOrFail($id);
            $learningResult->delete();
            return response()->json([
                'message' => 'El resultado de aprendizaje ha sido eliminado.',
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Error al eliminar el resultado de aprendizaje.',
            ], 500);
        }
    }
}
