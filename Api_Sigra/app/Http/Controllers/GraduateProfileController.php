<?php

namespace App\Http\Controllers;

use App\Models\GraduateProfile;
use Illuminate\Http\Request;

class GraduateProfileController extends Controller
{
    public function index()
    {
        try {
            $graduateProfiles = GraduateProfile::paginate(10);
            return response()->json([
                'graduate_profiles' => $graduateProfiles,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'No se pudieron obtener los perfiles de graduado.',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "skills" => "required|string",
                // "knowledge" => "required|string",
                "program_id" => "required|exists:programs,id",
                //poner unico para 2 campos
            ]);

            $graduateProfile = GraduateProfile::create($validatedData);

            return response()->json([
                'message' => 'Perfil de graduado creado con éxito.',
                'graduate_profile' => $graduateProfile,
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
            $graduateProfile = GraduateProfile::findOrFail($id);
            return response()->json([
                'graduate_profile' => $graduateProfile,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Perfil de graduado no encontrado.',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $graduateProfile = GraduateProfile::findOrFail($id);
            $validatedData = $request->validate([
                'skills' => 'nullable|string',
                // 'knowledge' => 'nullable|string',
                'program_id' => 'nullable|exists:programs,id',
            ]);

            $graduateProfile->update($validatedData);

            return response()->json([
                'message' => 'Perfil de graduado actualizado exitosamente.',
                'graduate_profile' => $graduateProfile,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Error al actualizar el perfil de graduado.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $graduateProfile = GraduateProfile::findOrFail($id);
            $graduateProfile->delete();
            return response()->json([
                'message' => 'El perfil de graduado ha sido eliminado.',
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Error al eliminar el perfil de graduado.',
            ], 500);
        }
    }
}
