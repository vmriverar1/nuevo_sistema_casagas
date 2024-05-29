<?php

namespace App\Http\Controllers;

use App\Models\PettyCash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PettyCashController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pettyCashes = PettyCash::all();
        return response()->json($pettyCashes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'responsible' => 'required|string|max:255',
            'income' => 'required|numeric',
            'expense' => 'required|numeric',
            'initial' => 'required|numeric',
            'status' => 'required|string|in:abierta,cerrada,desactivada',
            'branch_id' => 'required|exists:branches,id',
        ]);

        $pettyCash = PettyCash::create($validatedData);

        return response()->json($pettyCash, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PettyCash $pettyCash)
    {
        return response()->json($pettyCash);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PettyCash $pettyCash)
    {
        $validatedData = $request->validate([
            'responsible' => 'string|max:255',
            'income' => 'numeric',
            'expense' => 'numeric',
            'initial' => 'numeric',
            'status' => 'string|in:abierta,cerrada,desactivada',
            'branch_id' => 'exists:branches,id',
        ]);

        $pettyCash->update($validatedData);

        return response()->json($pettyCash);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PettyCash $pettyCash)
    {
        $pettyCash->update(['status' => 'eliminado']);

        return response()->json(null, 204);
    }
}
