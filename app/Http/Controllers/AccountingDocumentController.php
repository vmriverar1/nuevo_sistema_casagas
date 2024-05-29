<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountingDocument;

class AccountingDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = AccountingDocument::all();
        return response()->json($documents);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'electronic_billing' => 'required|boolean',
            'tax_type' => 'required|string|in:included in the price,add to the price',
            'sale_percentage' => 'required|numeric',
            'print_document' => 'required|string|max:255',
            'prefix_numbering' => 'required|string|max:255',
            'start_numbering' => 'required|integer',
            'mail_shipping' => 'required|boolean',
            'branch_id' => 'required|exists:branches,id',
        ]);

        $document = AccountingDocument::create($validatedData);

        return response()->json($document, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(AccountingDocument $accountingDocument)
    {
        return response()->json($accountingDocument);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AccountingDocument $accountingDocument)
    {
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'electronic_billing' => 'boolean',
            'tax_type' => 'string|in:included in the price,add to the price',
            'sale_percentage' => 'numeric',
            'print_document' => 'string|max:255',
            'prefix_numbering' => 'string|max:255',
            'start_numbering' => 'integer',
            'mail_shipping' => 'boolean',
            'branch_id' => 'exists:branches,id',
        ]);

        $accountingDocument->update($validatedData);

        return response()->json($accountingDocument);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccountingDocument $accountingDocument)
    {
        $accountingDocument->update(['status' => 'eliminado']);

        return response()->json(null, 204);
    }
}
