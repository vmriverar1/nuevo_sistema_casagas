<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouses = Warehouse::all();
        return response()->json($warehouses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'warehouse_type' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'manager' => 'required|exists:users,id',
            'branch_id' => 'required|exists:branches,id',
        ]);

        if ($request->hasFile('photo')) {
            // Verificar si la carpeta existe, si no, crearla
            if (!Storage::disk('public')->exists('branch')) {
                Storage::disk('public')->makeDirectory('branch');
            }

            $file = $request->file('photo');
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/branch', $filename);

            $validatedData['photo'] = 'storage/branch/' . $filename;
        }

        $warehouse = Warehouse::create($validatedData);

        return response()->json($warehouse, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Warehouse $warehouse)
    {
        return response()->json($warehouse);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        $validatedData = $request->validate([
            'location' => 'string|max:255',
            'capacity' => 'integer',
            'warehouse_type' => 'string|max:255',
            'status' => 'string|max:255',
            'manager' => 'exists:users,id',
            'branch_id' => 'exists:branches,id',
        ]);

        // Manejar la imagen
        if ($request->hasFile('photo')) {
            // Verificar si la carpeta existe, si no, crearla
            if (!Storage::disk('public')->exists('warehouse')) {
                Storage::disk('public')->makeDirectory('warehouse');
            }

            // Eliminar la imagen anterior si existe
            if ($warehouse->photo) {
                Storage::disk('public')->delete($warehouse->photo);
            }

            // Guardar la nueva imagen
            $file = $request->file('photo');
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/warehouse', $filename);

            // Actualizar la ruta de la imagen en los datos validados
            $validatedData['photo'] = 'warehouse/' . $filename;
        }

        $warehouse->update($validatedData);

        return response()->json($warehouse);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        $warehouse->update(['status' => 'eliminado']);
        return response()->json(null, 204);
    }
}
