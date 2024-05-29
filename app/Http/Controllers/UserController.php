<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Support\Str;
use App\Helpers\PhotoHelper;
use App\Helpers\TableHelper;
use Illuminate\Http\Request;
use App\Helpers\BranchHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function page_user()
    {
        $roles = Role::all();

        return view('/usuarios',compact('roles'));
    }

    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if ($user) {
            return response()->json([
                'exists' => true,
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'document_type' => $user->document_type,
                    'document' => $user->document,
                    'birthday' => $user->birthday,
                    'phone' => $user->phone,
                    'address' => $user->address,
                    'photo' => 'storage/user/'.$user->photo,
                ]
            ]);
        } else {
            return response()->json(['exists' => false]);
        }
    }

    public function changeStatus(Request $request)
    {
        $userId = $request->input('user_id');
        $status = $request->input('status');

        $user = User::find($userId);
        $branch = BranchHelper::getBranchIdFromSession();

        if ($user) {
            if ($status == 'Activo') {
                $newStatus = 'inactivo';
            } else {
                $newStatus = 'activo';
            }

            DB::table('user_branch')
                ->where('user_id', $userId)
                ->where('branch_id', $branch->id)
                ->update(['status' => $newStatus]);


            $updatedStatus = DB::table('user_branch')
                                 ->where('user_id', $userId)
                                 ->where('branch_id', $branch->id)
                                 ->value('status');

            $btn_html = TableHelper::formatStatus("user", $updatedStatus, $user->id);

            return response()->json(['newBtn' => $btn_html]);
        }

        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $branch = BranchHelper::getBranchIdFromSession();
        // Obtener todos los usuarios relacionados a la branch
        $users = $branch->users()->where('profile', 'usuario')->get();

        $users->transform(function($user) use ($branch) {
            $user->photo = PhotoHelper::formatPhoto("user", $user->photo);
            $user->status = $user->pivot->status;
            $user->status = TableHelper::formatStatus("user", $user->status, $user->id);

            // Obtener el rol del usuario para la branch actual
            $role = $user->roles()->first();
            $user->role = $role ? $role->name : 'No asignado';

            return $user;
        });

        // Retornar la respuesta en formato JSON
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
            'role' => 'required|exists:roles,id',
            'document' => 'nullable|string|max:255',
            'document_type' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
            'status' => 'nullable|string|max:255',
            'profile' => 'nullable|string|max:255',
            'data' => 'nullable|array',
        ]);

        $branch = BranchHelper::getBranchIdFromSession();
        if ($branch instanceof \Illuminate\Http\JsonResponse) {
            return $branch;
        }

        DB::beginTransaction();
        try {
            $user = User::where('email', $request['email'])->first();
            if ($user) {
                // Log::error('Usuario existe.');
                $updateData = $request->except(['email', 'password']);
                $updateData['photo'] = PhotoHelper::updatePhoto($user, 'users', $request);
                $user->update($updateData);
            }else{
                // Log::error('Usuario no existe.');
                $validatedData['photo'] = PhotoHelper::submitPhoto('users', $request);
                $validatedData['password'] = Hash::make($validatedData['password']);
                $user = User::create($validatedData);
            }

            // Verificar y asociar la relación user_branch
            if ($branch && !$user->branches()->where('branch_id', $branch->id)->exists()) {
                $user->branches()->attach($branch->id);
            }

            // Verificar y asociar la relación role_user
            $roleId = $request->role;
            $currentRoleId = $user->roles()->pluck('role_id')->first();

            if ($currentRoleId && $currentRoleId != $roleId) {
                // Actualizar el rol si es diferente
                $user->roles()->sync([$roleId]);
                Log::info('Rol actualizado para el usuario.', ['user_id' => $user->id, 'role_id' => $roleId]);
            } elseif (!$currentRoleId) {
                // Crear la relación si no existe
                $user->roles()->attach($roleId);
                Log::info('Rol asignado para el usuario.', ['user_id' => $user->id, 'role_id' => $roleId]);
            }

            DB::commit();
            return response()->json($user, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al guardar el usuario: ' . $e->getMessage());
            return response()->json(['error' => 'Error al guardar el usuario.'], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $role = $user->roles()->first();
        $user->role = $role ? $role->id : 'No asignado';
        $user->birthday = $user->birthday ? Carbon::parse($user->birthday)->format('Y-m-d') : null;
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'string|min:8|nullable',
            'role' => 'required|exists:roles,id',
            'document' => 'nullable|string|max:255',
            'document_type' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
            'status' => 'nullable|string|max:255',
            'profile' => 'nullable|string|max:255',
            'data' => 'nullable|array',
        ]);

        DB::beginTransaction();
        try {
            $validatedData['photo'] = PhotoHelper::updatePhoto($user, 'users', $request);

            if (!empty($validatedData['password'])) {
                $validatedData['password'] = Hash::make($validatedData['password']);
            } else {
                unset($validatedData['password']);
            }

            $user->update($validatedData);

            // Verificar y asociar la relación role_user
            $roleId = $request->role;
            $currentRoleId = $user->roles()->pluck('role_id')->first();

            if ($currentRoleId && $currentRoleId != $roleId) {
                // Actualizar el rol si es diferente
                $user->roles()->sync([$roleId]);
                Log::info('Rol actualizado para el usuario.', ['user_id' => $user->id, 'role_id' => $roleId]);
            } elseif (!$currentRoleId) {
                // Crear la relación si no existe
                $user->roles()->attach($roleId);
                Log::info('Rol asignado para el usuario.', ['user_id' => $user->id, 'role_id' => $roleId]);
            }

            DB::commit();

            return response()->json($user);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar el usuario: ' . $e->getMessage());
            return response()->json(['error' => 'Error al actualizar el usuario.'], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $branch = BranchHelper::getBranchIdFromSession();

        DB::table('user_branch')
                ->where('user_id', $user->id)
                ->where('branch_id', $branch->id)
                ->delete();

        return response()->json(null, 204);
    }
}
