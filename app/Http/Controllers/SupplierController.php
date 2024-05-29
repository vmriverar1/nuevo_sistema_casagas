<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Helpers\PhotoHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function page_supplier()
    {
        $users = User::all();

        return view('/proveedores',compact('users'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::where('profile', 'proveedor')->get();
        $users->transform(function($user) {
            $user->photo = PhotoHelper::formatPhoto("supplier", $user->photo);
            return $user;
        });

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'document' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
            'status' => 'nullable|string|max:255',
            'profile' => 'nullable|string|max:255',
            'data' => 'nullable|array',
        ]);

        $validatedData['photo'] = PhotoHelper::submitPhoto('supplier', $request);
        $validatedData['password'] = Hash::make("password");
        $validatedData['profile'] = "proveedor";
        $validatedData['email'] = $validatedData['document'] . '@temporal.com';

        $user = User::create($validatedData);

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $supplier = User::where('profile', 'proveedor')->findOrFail($id);
        return response()->json($supplier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $supplier = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $supplier->id,
            'document' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
            'status' => 'nullable|string|max:255',
            'profile' => 'nullable|string|max:255',
            'data' => 'nullable|array',
        ]);

        $validatedData['photo'] = PhotoHelper::updatePhoto($supplier, 'supplier', $request);

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $supplier->update($validatedData);
        return response()->json($supplier);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $supplier = User::where('profile', 'proveedor')->findOrFail($id);
        $supplier->delete();
        return response()->json(null, 204);
    }
}
