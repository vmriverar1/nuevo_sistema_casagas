<?php

namespace App\Http\Controllers;

use App\Models\UserPlate;
use App\Models\User;
use Illuminate\Http\Request;

class UserPlateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userPlates = UserPlate::all();
        return response()->json($userPlates);
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
            'user_id' => 'required|exists:users,id',
            'plate_number' => 'required|string|max:255',
        ]);

        $userPlate = UserPlate::create($request->all());
        return response()->json($userPlate, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userPlate = UserPlate::findOrFail($id);
        return response()->json($userPlate);
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
            'user_id' => 'required|exists:users,id',
            'plate_number' => 'required|string|max:255',
        ]);

        $userPlate = UserPlate::findOrFail($id);
        $userPlate->update($request->all());
        return response()->json($userPlate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userPlate = UserPlate::findOrFail($id);
        $userPlate->delete();
        return response()->json(null, 204);
    }
}
