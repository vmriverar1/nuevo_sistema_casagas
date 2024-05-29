<?php

namespace App\Http\Controllers;

use App\Models\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requirements = Requirement::all();
        return response()->json($requirements);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $requirement = Requirement::create($validatedData);

        return response()->json($requirement, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Requirement $requirement)
    {
        return response()->json($requirement);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Requirement $requirement)
    {
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'type' => 'string|max:255',
        ]);

        $requirement->update($validatedData);

        return response()->json($requirement);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Requirement $requirement)
    {
        $requirement->update(['status' => 'eliminado']);

        return response()->json(null, 204);
    }
}
