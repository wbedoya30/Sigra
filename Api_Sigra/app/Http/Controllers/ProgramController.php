<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        try {
            $programs = Program::paginate(10);
            return response()->json([
                'programs' => $programs,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'No se pudieron obtener los programas académicos.',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "name" => "required|string|unique:programs,name|max:255",
                "description" => "required|string",
                "duration" => "required|string",
                "awarded_title" => "required|string",
                "image"=> "nullable|string",
                "coordinator_id" => "required|exists:users,id",
                //configurar unico para varios campos en el mismo regisro
            ]);

            $program = Program::create($validatedData);

            return response()->json([
                'message' => 'Programa creado con éxito.',
                'program' => $program,
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
            $program = Program::findOrFail($id);
            return response()->json([
                'program' => $program,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Programa no encontrado.',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $program = Program::findOrFail($id);
            $validatedData = $request->validate([
                'name' => 'nullable|string|max:255' .$program->id,
                'description' => 'nullable|string',
                'duration' => 'nullable|string',
                'awarded_title' => 'nullable|string',
                "image"=> "nullable|string",
                'coordinator_id' => 'nullable|exists:users,id',
            ]);

            $program->update($validatedData);

            return response()->json([
                'message' => 'Programa actualizado exitosamente.',
                'program' => $program,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Error al actualizar el programa.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $program = Program::findOrFail($id);
            $program->delete();
            return response()->json([
                'message' => 'El programa ha sido eliminado.',
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Error al eliminar el programa.',
            ], 500);
        }
    }
}
