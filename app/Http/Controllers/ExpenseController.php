<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::all();
        return response()->json($expenses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'responsible' => 'required|string|max:255',
            'total' => 'required|numeric',
            'change' => 'required|numeric',
            'photograph' => 'required|string|max:255',
            'justification' => 'required|string',
            'branch_id' => 'required|exists:branches,id',
            'petty_cashes_id' => 'required|exists:petty_cashes,id',
        ]);

        $expense = Expense::create($validatedData);

        return response()->json($expense, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        return response()->json($expense);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $validatedData = $request->validate([
            'responsible' => 'string|max:255',
            'total' => 'numeric',
            'change' => 'numeric',
            'photograph' => 'string|max:255',
            'justification' => 'string',
            'branch_id' => 'exists:branches,id',
            'petty_cashes_id' => 'exists:petty_cashes,id',
        ]);

        $expense->update($validatedData);

        return response()->json($expense);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->update(['status' => 'eliminado']);

        return response()->json(null, 204);
    }
}
