<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function listar()
    {
        $car = Car::all();
        return response()->json([
            'status' => true,
            'message' => 'Carros listados com sucesso',
            'data' => $car
        ], 200);
    }

    public function mostrarId($id)
    {
        $car = Car::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Carro mostrado com sucesso',
            'data' => $car
        ], 200);
    }

    public function salvar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'placa' => 'required|string|max:10',
            'quilometragem' => 'required|numeric',
            'modelo' => 'required|string|max:50',
            'marca' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Erro de validacao',
                'errors' => $validator->errors()
            ], 422);
        }

        $car = Car::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Carro salvo com sucesso',
            'data' => $car
        ], 201);
    }

    public function editar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'placa' => 'required|string|max:10',
            'quilometragem' => 'required|numeric',
            'modelo' => 'required|string|max:50',
            'marca' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Erro de validacao',
                'errors' => $validator->errors()
            ], 422);
        }

        $car = Car::findOrFail($id);
        $car->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Carro editado com sucesso',
            'data' => $car
        ], 200);
    }

    public function excluir($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Carro deletado com sucesso'
        ], 200);
    }

}
