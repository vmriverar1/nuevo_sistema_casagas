<?php

namespace App\Http\Controllers;

use App\Models\SaleAdvance;
use Illuminate\Http\Request;

class SaleAdvanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adelanto = SaleAdvance::all();
        return response()->json($adelanto);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sale_id' => 'required|exists:sales,id',
            'advance_amount' => 'required|numeric',
            'change' => 'required|numeric',
        ]);

        $adelanto = SaleAdvance::create($request->all());
        return response()->json($adelanto, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $adelanto = SaleAdvance::findOrFail($id);
        return response()->json($adelanto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'sale_id' => 'required|exists:sales,id',
            'advance_amount' => 'required|numeric',
            'change' => 'required|numeric',
        ]);

        $adelanto = SaleAdvance::findOrFail($id);
        $adelanto->update($request->all());
        return response()->json($adelanto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adelanto = SaleAdvance::findOrFail($id);
        $adelanto->delete();
        return response()->json(null, 204);
    }
}
