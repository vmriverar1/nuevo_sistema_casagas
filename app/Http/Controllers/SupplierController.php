<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Helpers\PhotoHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        // Definir los mensajes de error personalizados
        $messages = [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe ser mayor que 255 caracteres.',
            'document.string' => 'El documento debe ser una cadena de texto.',
            'document.max' => 'El documento no debe ser mayor que 255 caracteres.',
            'phone.string' => 'El teléfono debe ser una cadena de texto.',
            'phone.max' => 'El teléfono no debe ser mayor que 255 caracteres.',
            'address.string' => 'La dirección debe ser una cadena de texto.',
            'address.max' => 'La dirección no debe ser mayor que 255 caracteres.',
            'birthday.date' => 'La fecha de nacimiento no es una fecha válida.',
            'photo.image' => 'La foto debe ser una imagen.',
            'photo.mimes' => 'La foto debe ser un archivo de tipo: jpeg, png, jpg, gif.',
            'photo.max' => 'La foto no debe ser mayor que 2048 kilobytes.',
            'status.string' => 'El estado debe ser una cadena de texto.',
            'status.max' => 'El estado no debe ser mayor que 255 caracteres.',
            'profile.string' => 'El perfil debe ser una cadena de texto.',
            'profile.max' => 'El perfil no debe ser mayor que 255 caracteres.',
            'data.array' => 'El campo data debe ser un arreglo.',
        ];

        try {
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
            ], $messages);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        try {
            $validatedData['photo'] = PhotoHelper::submitPhoto('supplier', $request);
            $validatedData['password'] = Hash::make("password");
            $validatedData['profile'] = "proveedor";
            $validatedData['email'] = $validatedData['document'] . '@temporal.com';
            $validatedData['phone'] = $validatedData['phone'] ?? 'No disponible';
            $validatedData['address'] = $validatedData['address'] ?? 'No disponible';

            $user = User::create($validatedData);

            return response()->json($user, 201);
        } catch (\Exception $e) {
            Log::error('Error al crear el usuario: ' . $e->getMessage());
            return response()->json(['error' => 'Error al crear el usuario.'], 500);
        }
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
        $validatedData['phone'] = $validatedData['phone'] ?? 'No disponible';
        $validatedData['address'] = $validatedData['address'] ?? 'No disponible';

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
