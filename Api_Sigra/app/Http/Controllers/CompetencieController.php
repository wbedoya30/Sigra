<?php

namespace App\Http\Controllers;

use App\Models\Competencie;
use Illuminate\Http\Request;

class CompetencieController extends Controller
{
    public function index()
    {
        try {
            // $competencies = Competencie::paginate(10);
            $competencies = Competencie::all();
            return response()->json([
                'competencies' => $competencies,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'No se pudieron obtener las competencias.',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'type' => 'required|in:1,general, 2,especifica',
                "description" => "required|string",
                // "capabilities" => "required|string",
                "graduate_profile_id" => "required|exists:graduate_profiles,id",
                //manejo de unico para 2 campos
            ]);

            $competencie = competencie::create($validatedData);

            return response()->json([
                'message' => 'Competencia creada con éxito.',
                'competencie' => $competencie,
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
            // $competencie = competencie::findOrFail($id);
            $competencie = Competencie::with(['graduateProfile', 'graduateProfile.program'])->findOrFail($id);
            return response()->json([
                'competencie' => $competencie,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Competencia no encontrada.',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $competencie = competencie::findOrFail($id);
            $validatedData = $request->validate([
                'type' => 'nullable|in:1,general, 2,especifica',
                'description' => 'nullable|string',
                // 'capabilities' => 'nullable|string',
                'graduate_profile_id' => 'nullable|exists:graduate_profiles,id',
            ]);

            $competencie->update($validatedData);

            return response()->json([
                'message' => 'Competencia actualizada exitosamente.',
                'competencie' => $competencie,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Error al actualizar la competencia.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $competencie = competencie::findOrFail($id);
            $competencie->delete();
            return response()->json([
                'message' => 'La competencia ha sido eliminada.',
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Error al eliminar la competencia.',
            ], 500);
        }
    }
}
