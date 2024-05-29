<?php

namespace App\Helpers;

use App\Models\Branch;
use Illuminate\Support\Facades\Log;

class BranchHelper
{
    public static function getBranchIdFromSession()
    {
        // Obtener el 'cun' desde la sesión
        $cun = session('cun');

        // Verificar si el 'cun' está presente en la sesión
        if (!$cun) {
            Log::error('No se encontró el CUN en la sesión.');
            return response()->json(['error' => 'No se encontró el CUN en la sesión.'], 400);
        }

        // Buscar la branch correspondiente usando el 'cun'
        $branch = Branch::where('cun', $cun)->first();

        // Verificar si se encontró la branch
        if (!$branch) {
            // Log::error('No se encontró una sucursal con el CUN proporcionado.');
            return response()->json(['error' => 'No se encontró una sucursal con el CUN proporcionado.'], 404);
        }

        return $branch;
    }
}
