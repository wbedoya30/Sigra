<?php

namespace App\Http\Controllers;

use App\Models\Pensum;
use Exception;
use Illuminate\Http\Request;

class PensumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        //
        return response()->json([
            'data'=>Pensum::all(),
            'status'=> 200,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        //
        try{
            $data = Pensum:: create($request->all());
            return response()->json( [
                'data' => $data,
                'status'=> 200,
            ]);
        }
        catch(Exception $err){
            return response()->json( [
                'error' => $err->getMessage(),
                'status'=> 500,
            ]);
        }
    }

    /**
     * Display the specified resource.
     */

     //revisar si pasar un objeto(Subject $subject) o un id
    public function show($id){
        try{
            return response()->json( [
                'data'=>Pensum::find($id),
                'status'=> 200,
            ]);
        }
        catch(Exception $err){
            return response()->json( [
                'error' => $err->getMessage(),
                'status'=> 500,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id){
        //
        try{
            $data = Pensum::findOrFail($id);
            $data -> update($request->all());
            return response()->json( [
                'data' => $data,
                'status'=> 200,
            ]);
        }
        catch(Exception $err){
            return response()->json( [
                'error' => $err->getMessage(),
                'status'=> 500,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        try{
            $data = Pensum::findOrFail($id);
            $data -> delete();
            return response()->json( [
                'data' => $id,
                'status'=> 200,
            ]);
        }
        catch(Exception $err){
            return response()->json( [
                'error' => $err->getMessage(),
                'status'=> 500,
            ]);
        }
    }
}
