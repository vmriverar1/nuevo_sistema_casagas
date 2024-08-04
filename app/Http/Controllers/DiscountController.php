<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;
use App\Helpers\BranchHelper;
use Illuminate\Support\Facades\Log;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discounts = Discount::all();
        return response()->json($discounts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Definir los mensajes de error personalizados
        $messages = [
            'name.required' => 'El nombre del descuento es obligatorio.',
            'status.required' => 'El estado del descuento es obligatorio.',
            'status.in' => 'El estado debe ser "Activado" o "Desactivado".',
            'type.required' => 'El tipo de descuento es obligatorio.',
            'type.in' => 'El tipo debe ser "porcentaje" o "fijo".',
            'markdown.required' => 'El valor del descuento es obligatorio.',
            'markdown.numeric' => 'El valor del descuento debe ser un número.',
        ];

        $branch = BranchHelper::getBranchIdFromSession();

        // Validar la solicitud
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'status' => 'required|in:Activado,Desactivado',
                'type' => 'required|in:porcentaje,fijo',
                'markdown' => 'required|numeric',
            ], $messages);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        // Crear el descuento
        try {
            $validatedData['branch_id'] = $branch->id;
            $discount = Discount::create($validatedData);
            return response()->json($discount, 201);
        } catch (\Exception $e) {
            Log::error('Error al crear el descuento: ' . $e->getMessage());
            return response()->json(['error' => 'Error al crear el descuento.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $discount = Discount::findOrFail($id);
        return response()->json($discount);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Definir los mensajes de error personalizados
        $messages = [
            'name.required' => 'El nombre del descuento es obligatorio.',
            'status.required' => 'El estado del descuento es obligatorio.',
            'status.in' => 'El estado debe ser "Activado" o "Desactivado".',
            'type.required' => 'El tipo de descuento es obligatorio.',
            'type.in' => 'El tipo debe ser "porcentaje" o "fijo".',
            'markdown.required' => 'El valor del descuento es obligatorio.',
            'markdown.numeric' => 'El valor del descuento debe ser un número.',
        ];

        $branch = BranchHelper::getBranchIdFromSession();

        // Validar la solicitud
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'status' => 'required|in:Activado,Desactivado',
                'type' => 'required|in:porcentaje,fijo',
                'markdown' => 'required|numeric',
            ], $messages);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        // Actualizar el descuento
        try {
            $validatedData['branch_id'] = $branch->id;
            $discount = Discount::findOrFail($id);
            $discount->update($validatedData);
            return response()->json($discount);
        } catch (\Exception $e) {
            Log::error('Error al actualizar el descuento: ' . $e->getMessage());
            return response()->json(['error' => 'Error al actualizar el descuento.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $discount = Discount::findOrFail($id);
            $discount->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            Log::error('Error al eliminar el descuento: ' . $e->getMessage());
            return response()->json(['error' => 'Error al eliminar el descuento.'], 500);
        }
    }
}
