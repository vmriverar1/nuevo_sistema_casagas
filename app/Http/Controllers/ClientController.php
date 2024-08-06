<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Helpers\PhotoHelper;
use App\Helpers\TableHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{

    public function page_client()
    {
        $users = User::all();

        return view('/clientes',compact('users'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::where('profile', 'cliente')->get();

        $users->transform(function($user) {
            $user->photo = PhotoHelper::formatPhoto("client", $user->photo);
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

        $validatedData['photo'] = PhotoHelper::submitPhoto('client', $request);
        $validatedData['password'] = Hash::make("password");
        $validatedData['profile'] = "cliente";
        $validatedData['email'] = $validatedData['document'] . '@temporal.com';
        $validatedData['phone'] = $validatedData['phone'] ?? 'No disponible';
        $validatedData['address'] = $validatedData['address'] ?? 'No disponible';

        $user = User::create($validatedData);

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $client = User::where('profile', 'cliente')->findOrFail($id);
        return response()->json($client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $client = User::findOrFail($id);
        Log::info("Array dato: " . print_r($client));

        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $client->id,
            'document' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
            'status' => 'nullable|string|max:255',
            'profile' => 'nullable|string|max:255',
            'data' => 'nullable|array',
        ]);

        $validatedData['photo'] = PhotoHelper::updatePhoto($client, 'client', $request);
        $validatedData['phone'] = $validatedData['phone'] ?? 'No disponible';
        $validatedData['address'] = $validatedData['address'] ?? 'No disponible';

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $client->update($validatedData);
        return response()->json($client);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $client = User::where('profile', 'cliente')->findOrFail($id);
        $client->delete();
        return response()->json(null, 204);
    }
}
