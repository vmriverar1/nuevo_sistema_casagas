<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Support\Str;
use App\Helpers\PhotoHelper;
use Illuminate\Http\Request;
use App\Helpers\BranchHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BranchController extends Controller
{
    public function choose_branch()
    {
        $branches = Branch::active()->get();
        return view('/elegir-tienda',compact('branches'));
    }

    public function choose_business($cun)
    {
        session(['cun' => $cun]);
        return redirect()->route('welcome');
    }

    public function page()
    {
        $branches = Branch::active()->get();
        $users = User::whereDoesntHave('roles', function($query) {
            $query->where('role_id', '100');
        })
        ->whereNotIn('profile', ['proveedor', 'cliente'])
        ->get();

        return view('/tiendas',compact('branches','users'));
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::active()->orderBy('company_name', 'asc')->get();
        // Transformar los datos para la vista
        $branches->transform(function($branch) {
            $pre = $branch->photo == "default.jpg" ? "storage/branch/" : "";
            $branch->photo = '<img src="' . asset( $pre . $branch->photo) . '" alt="Photo" width="50" height="50">';
            if ($branch->status == "activa") {
                $branch->status = '<button class="btn btn-success">Activo</button>';
            }else if($branch->status == "mantenimiento"){
                $branch->status = '<button class="btn btn-warning">Mantenimiento</button>';
            } else {
                $branch->status = '<button class="btn btn-danger">Inactivo</button>';
            }
            return $branch;
        });
        return response()->json($branches);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Definir los mensajes de error personalizados
        $messages = [
            'company_name.required' => 'El nombre de la compañía es obligatorio.',
            'company_name.string' => 'El nombre de la compañía debe ser una cadena de texto.',
            'company_name.max' => 'El nombre de la compañía no debe ser mayor que 255 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.max' => 'El correo electrónico no debe ser mayor que 255 caracteres.',
            'ruc.required' => 'El RUC es obligatorio.',
            'ruc.string' => 'El RUC debe ser una cadena de texto.',
            'ruc.max' => 'El RUC no debe ser mayor que 255 caracteres.',
            'main_address.required' => 'La dirección principal es obligatoria.',
            'main_address.string' => 'La dirección principal debe ser una cadena de texto.',
            'main_address.max' => 'La dirección principal no debe ser mayor que 255 caracteres.',
            'secondary_address.string' => 'La dirección secundaria debe ser una cadena de texto.',
            'secondary_address.max' => 'La dirección secundaria no debe ser mayor que 255 caracteres.',
            'main_phone.required' => 'El teléfono principal es obligatorio.',
            'main_phone.string' => 'El teléfono principal debe ser una cadena de texto.',
            'main_phone.max' => 'El teléfono principal no debe ser mayor que 255 caracteres.',
            'secondary_phone.string' => 'El teléfono secundario debe ser una cadena de texto.',
            'secondary_phone.max' => 'El teléfono secundario no debe ser mayor que 255 caracteres.',
            'photo.image' => 'La foto debe ser una imagen.',
            'photo.mimes' => 'La foto debe ser un archivo de tipo: jpeg, png, jpg, gif.',
            'photo.max' => 'La foto no debe ser mayor que 2048 kilobytes.',
            'status.required' => 'El estado es obligatorio.',
            'status.string' => 'El estado debe ser una cadena de texto.',
            'branch_type.required' => 'El tipo de sucursal es obligatorio.',
            'branch_type.string' => 'El tipo de sucursal debe ser una cadena de texto.',
            'notes.string' => 'Las notas deben ser una cadena de texto.',
            'data.array' => 'El campo data debe ser un arreglo.',
        ];

        try {
            $validatedData = $request->validate([
                'company_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'ruc' => 'required|string|max:255',
                'main_address' => 'required|string|max:255',
                'secondary_address' => 'string|max:255|nullable',
                'main_phone' => 'required|string|max:255',
                'secondary_phone' => 'string|max:255|nullable',
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required|string',
                'branch_type' => 'required|string',
                'notes' => 'string|nullable',
                'data' => 'array|nullable',
                'admin_branch' => 'required|string',
            ], $messages);

            // Iniciar una transacción de base de datos
            DB::beginTransaction();

            // AGREGAMOS CÓDIGO ÚNICO
            $validatedData['cun'] = Str::uuid()->toString();

            // AGREGAMOS LA IMAGEN
            $validatedData['photo'] = PhotoHelper::submitPhoto('branch', $request);

            // Crear la sucursal
            $branch = Branch::create($validatedData);

            // Creamos la relación entre el usuario y la sucursal
            // ==================================================
            BranchHelper::createRelation('user_branch', $validatedData['admin_branch'], $branch->id, ['status' => 'activo']);

            // creamos la relación entre el administrador y la sucursal
            // ========================================================
            BranchHelper::createRelation('admin_branch', $validatedData['admin_branch'], $branch->id);

            // Creamos la relación entre el rol, usuario y la sucursal
            // ========================================================
            BranchHelper::createRelation('role_user', $validatedData['admin_branch'], $branch->id, ['role_id' => "2"]);

            // Obtener todos los usuarios con role_id 1 (Super admin)
            $superAdmins = User::whereHas('roles', function($query) {
                $query->where('role_id', '1');
            })->get();

            // Insertar en la tabla pivote role_user si no existe
            foreach ($superAdmins as $user) {

                // Creamos la relación entre el rol, usuario y la sucursal
                // ========================================================
                BranchHelper::createRelation('role_user', $user->id, $branch->id, ['role_id' => "1"]);

                // Creamos la relación entre el usuario y la sucursal
                // ==================================================
                BranchHelper::createRelation('user_branch', $user->id, $branch->id, ['status' => 'activo']);
            }

            // Confirmar la transacción
            DB::commit();

            return response()->json($branch, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();

            $errors = $e->errors();
            $detailedErrors = [];

            foreach ($errors as $field => $messages) {
                $detailedErrors[] = [
                    'campo' => $field,
                    'errores' => $messages,
                ];
            }

            return response()->json([
                'message' => 'Errores de validación',
                'errors' => $detailedErrors,
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error al crear la sucursal: ' . $e->getMessage());
            return response()->json(['error' => 'Error al crear la sucursal.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        // Cargar la relación usersAdmin
        $branch->load('usersAdmin');

        // Verificar si existe al menos un administrador en users_admin
        if ($branch->usersAdmin->isNotEmpty()) {
            // Asignar el id del primer administrador al atributo admin_branch
            $branch->admin_branch = $branch->usersAdmin->first()->id;
        } else {
            // Asignar null si no hay administradores
            $branch->admin_branch = null;
        }

        return response()->json($branch);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        // Definir los mensajes de error personalizados
        $messages = [
            'company_name.string' => 'El nombre de la compañía debe ser una cadena de texto.',
            'company_name.max' => 'El nombre de la compañía no debe ser mayor que 255 caracteres.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.max' => 'El correo electrónico no debe ser mayor que 255 caracteres.',
            'ruc.string' => 'El RUC debe ser una cadena de texto.',
            'ruc.max' => 'El RUC no debe ser mayor que 255 caracteres.',
            'main_address.string' => 'La dirección principal debe ser una cadena de texto.',
            'main_address.max' => 'La dirección principal no debe ser mayor que 255 caracteres.',
            'secondary_address.string' => 'La dirección secundaria debe ser una cadena de texto.',
            'secondary_address.max' => 'La dirección secundaria no debe ser mayor que 255 caracteres.',
            'main_phone.string' => 'El teléfono principal debe ser una cadena de texto.',
            'main_phone.max' => 'El teléfono principal no debe ser mayor que 255 caracteres.',
            'secondary_phone.string' => 'El teléfono secundario debe ser una cadena de texto.',
            'secondary_phone.max' => 'El teléfono secundario no debe ser mayor que 255 caracteres.',
            'photo.image' => 'La foto debe ser una imagen.',
            'photo.mimes' => 'La foto debe ser un archivo de tipo: jpeg, png, jpg, gif.',
            'photo.max' => 'La foto no debe ser mayor que 2048 kilobytes.',
            'status.string' => 'El estado debe ser una cadena de texto.',
            'branch_type.string' => 'El tipo de sucursal debe ser una cadena de texto.',
            'notes.string' => 'Las notas deben ser una cadena de texto.',
            'data.array' => 'El campo data debe ser un arreglo.',
        ];

        // Validar la solicitud
        $validatedData = $request->validate([
            'company_name' => 'string|max:255',
            'email' => 'email|max:255',
            'ruc' => 'string|max:255',
            'main_address' => 'string|max:255',
            'secondary_address' => 'string|max:255|nullable',
            'main_phone' => 'string|max:255',
            'secondary_phone' => 'string|max:255|nullable',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
            'status' => 'string',
            'branch_type' => 'string',
            'notes' => 'string|nullable',
            'data' => 'array|nullable',
        ], $messages);

        DB::beginTransaction();

        try {
            // Manejar la imagen
            $validatedData['photo'] = PhotoHelper::updatePhoto($branch, 'branch', $request);

            // Actualizar los datos de la sucursal
            $branch->update($validatedData);

            // Depuración: Verificar si existen relaciones antes de eliminarlas
            DB::table('user_branch')->where('branch_id', $branch->id)->get();
            DB::table('admin_branch')->where('branch_id', $branch->id)->get();
            DB::table('role_user')->where('branch_id', $branch->id)->get();

            // Eliminar relaciones en las tablas pivote
            DB::table('user_branch')->where('branch_id', $branch->id)->delete();
            DB::table('admin_branch')->where('branch_id', $branch->id)->delete();
            DB::table('role_user')->where('branch_id', $branch->id)->delete();

            // Actualizar las relaciones en las tablas pivote
            BranchHelper::updateRelation('user_branch', $validatedData['admin_branch'], $branch->id, ['status' => 'activo']);
            BranchHelper::updateRelation('admin_branch', $validatedData['admin_branch'], $branch->id);
            BranchHelper::updateRelation('role_user', $validatedData['admin_branch'], $branch->id, ['role_id' => "2"]);

            // Obtener todos los usuarios con role_id 1 (Super admin)
            $superAdmins = User::whereHas('roles', function($query) {
                $query->where('role_id', '1');
            })->get();

            foreach ($superAdmins as $user) {
                BranchHelper::updateRelation('role_user', $user->id, $branch->id, ['role_id' => "1"]);
                BranchHelper::updateRelation('user_branch', $user->id, $branch->id, ['status' => 'activo']);
            }

            DB::commit();

            return response()->json($branch);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar la sucursal: ' . $e->getMessage());
            return response()->json(['error' => 'Error al actualizar la sucursal.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        DB::beginTransaction();

        try {
            // Depuración: Verificar si existen relaciones antes de eliminarlas
            DB::table('user_branch')->where('branch_id', $branch->id)->get();
            DB::table('admin_branch')->where('branch_id', $branch->id)->get();
            DB::table('role_user')->where('branch_id', $branch->id)->get();

            // Eliminar relaciones en las tablas pivote
            DB::table('user_branch')->where('branch_id', $branch->id)->delete();
            DB::table('admin_branch')->where('branch_id', $branch->id)->delete();
            DB::table('role_user')->where('branch_id', $branch->id)->delete();

            // Eliminar la imagen de la sucursal si existe
            if ($branch->photo && Storage::disk('public')->exists($branch->photo)) {
                Storage::disk('public')->delete($branch->photo);
            }

            // Eliminar la sucursal
            $branch->delete();

            DB::commit();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar la sucursal: ' . $e->getMessage());
            return response()->json(['error' => 'Error al eliminar la sucursal.'], 500);
        }
    }

}
