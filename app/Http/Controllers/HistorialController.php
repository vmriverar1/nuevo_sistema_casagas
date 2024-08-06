<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use Illuminate\Http\Request;

class HistorialController extends Controller
{
    public function index()
    {
        $historiales = Historial::all();
        return response()->json($historiales);
    }

    public function show($id)
    {
        $historial = Historial::findOrFail($id);
        return response()->json($historial);
    }
}
