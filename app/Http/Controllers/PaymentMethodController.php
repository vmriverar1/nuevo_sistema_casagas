<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::all();
        return response()->json($paymentMethods);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'commission' => 'required|numeric',
            'requirement_id' => 'required|exists:requirements,id',
            'branch_id' => 'required|exists:branches,id',
        ]);

        $paymentMethod = PaymentMethod::create($validatedData);

        return response()->json($paymentMethod, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentMethod $paymentMethod)
    {
        return response()->json($paymentMethod);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'commission' => 'numeric',
            'requirement_id' => 'exists:requirements,id',
            'branch_id' => 'exists:branches,id',
        ]);

        $paymentMethod->update($validatedData);

        return response()->json($paymentMethod);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->update(['status' => 'eliminado']);

        return response()->json(null, 204);
    }
}
