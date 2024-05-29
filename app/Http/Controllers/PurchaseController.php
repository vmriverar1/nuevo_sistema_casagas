<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::all();
        return response()->json($purchases);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required|string|in:pending payment,paid,cancelled,deleted',
            'supplier_id' => 'required|exists:users,id',
            'seller_id' => 'required|exists:users,id',
            'net' => 'required|numeric',
            'discount' => 'required|numeric',
            'accounting_document_id' => 'required|exists:accounting_documents,id',
            'total' => 'required|numeric',
            'petty_cashes_id' => 'required|exists:petty_cashes,id',
        ]);

        $purchase = Purchase::create($validatedData);

        return response()->json($purchase, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        return response()->json($purchase);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        $validatedData = $request->validate([
            'status' => 'string|in:pending payment,paid,cancelled,deleted',
            'supplier_id' => 'exists:users,id',
            'seller_id' => 'exists:users,id',
            'net' => 'numeric',
            'discount' => 'numeric',
            'accounting_document_id' => 'exists:accounting_documents,id',
            'total' => 'numeric',
            'petty_cashes_id' => 'exists:petty_cashes,id',
        ]);

        $purchase->update($validatedData);

        return response()->json($purchase);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->update(['status' => 'eliminado']);

        return response()->json(null, 204);
    }
}
