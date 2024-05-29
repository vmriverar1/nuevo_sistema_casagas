<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::all();
        return response()->json($sales);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required|string|in:in process,charged,cancelled,deleted',
            'customer_id' => 'required|exists:users,id',
            'seller_id' => 'required|exists:users,id',
            'net_amount' => 'required|numeric',
            'discount' => 'required|numeric',
            'accounting_document_id' => 'required|exists:accounting_documents,id',
            'total' => 'required|numeric',
            'change' => 'required|numeric',
            'branch_id' => 'required|exists:branches,id',
            'petty_cashes_id' => 'required|exists:petty_cashes,id',
        ]);

        $sale = Sale::create($validatedData);

        return response()->json($sale, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return response()->json($sale);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        $validatedData = $request->validate([
            'status' => 'string|in:in process,charged,cancelled,deleted',
            'customer_id' => 'exists:users,id',
            'seller_id' => 'exists:users,id',
            'net_amount' => 'numeric',
            'discount' => 'numeric',
            'accounting_document_id' => 'exists:accounting_documents,id',
            'total' => 'numeric',
            'change' => 'numeric',
            'branch_id' => 'exists:branches,id',
            'petty_cashes_id' => 'exists:petty_cashes,id',
        ]);

        $sale->update($validatedData);

        return response()->json($sale);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->update(['status' => 'eliminado']);
        return response()->json(null, 204);
    }
}
