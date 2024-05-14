<?php

namespace App\Http\Controllers;

use App\Models\Pensum;
use Illuminate\Http\Request;

class PensumController extends Controller
{
    public function index()
    {
        try {
            $pensums = Pensum::paginate(10);
            return response()->json([
                'pensums' => $pensums,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'No se pudieron obtener los pensums.',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "subject_id" => "required|exists:subjects,id",
                "program_id" => "required|exists:programs,id",
            ]);

            $pensum = Pensum::create($validatedData);

            return response()->json([
                'message' => 'pensum creado con éxito.',
                'pensum' => $pensum,
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
            $pensum = Pensum::findOrFail($id);
            return response()->json([
                'pensum' => $pensum,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'pensum no encontrado.',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $pensum = Pensum::findOrFail($id);
            $validatedData = $request->validate([
                'subject_id' => 'nullable|exists:subjects,id',
                'program_id' => 'nullable|exists:programs,id',
            ]);

            $pensum->update($validatedData);

            return response()->json([
                'message' => 'pensum actualizado exitosamente.',
                'pensum' => $pensum,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Error al actualizar el pensum.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $pensum = Pensum::findOrFail($id);
            $pensum->delete();
            return response()->json([
                'message' => 'El pensum ha sido eliminado.',
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Error al eliminar el pensum.',
            ], 500);
        }
    }
}
