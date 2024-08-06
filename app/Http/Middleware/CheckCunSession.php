<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

use function Laravel\Prompts\error;

class CheckCunSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cun = $request->session()->get('cun');
        error_log($cun);
        if (!$cun || !Branch::where('cun', $cun)->exists()) {
            return redirect()->route('elegir-tienda');
        }

        return $next($request);
    }
}
