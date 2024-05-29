<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        try {
            // $subjects = Subject::paginate(10);
            // $subjects = Subject::all();
            $subjects = Subject::with('program')->get();
            return response()->json([
                'subjects' => $subjects,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'No se pudieron obtener las asignaturas.',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "name" => "required|string|unique:subjects,name|max:255",
                "code" => "required|string|unique:subjects,code|max:50",
                "credits" => "required|string",
                "description" => "required|string",
                'status' => 'nullable|boolean',
            ]);

            $subject = Subject::create($validatedData);

            return response()->json([
                'message' => 'Asignatura creada con éxito.',
                'subject' => $subject,
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
            // $subject = Subject::findOrFail($id);
            $subject = Subject::with('program')->findOrFail($id);
            return response()->json([
                'subject' => $subject,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Asignatura no encontrada.',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $subject = Subject::findOrFail($id);
            $validatedData = $request->validate([
                'name' => 'nullable|string|max:255' .$subject->id,
                'code' => 'nullable|string|max:50',
                'credits' => 'nullable|string',
                'description' => 'nullable|string',
                'status' => 'nullable|boolean',
            ]);

            $subject->update($validatedData);

            return response()->json([
                'message' => 'Asignatura actualizada exitosamente.',
                'subject' => $subject,
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Error al actualizar la Asignatura.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $subject = Subject::findOrFail($id);
            //$subject->delete();
            $subject->update(['status' => false]);
            return response()->json([
                'message' => 'La Asignatura ha sido eliminada.',
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => $err->getMessage(),
                'error' => 'Error al eliminar la Asignatura.',
            ], 500);
        }
    }
}
