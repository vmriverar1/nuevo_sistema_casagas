<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
        $users = User::all();

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
        // Validar la solicitud
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
        ]);

        // AGREGAMOS CÓDIGO ÚNICO
        $validatedData['cun'] = Str::uuid()->toString();

        // AGREGAMOS LA IMAGEN
        if ($request->hasFile('photo')) {
            // Verificar si la carpeta existe, si no, crearla
            if (!Storage::disk('public')->exists('branch')) {
                Storage::disk('public')->makeDirectory('branch');
            }

            $file = $request->file('photo');
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/branch', $filename);

            $validatedData['photo'] = 'storage/branch/' . $filename;
        }

        $branch = Branch::create($validatedData);
        return response()->json($branch, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        return response()->json($branch);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
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
        ]);

        // Manejar la imagen
        if ($request->hasFile('photo')) {
            // Verificar si la carpeta existe, si no, crearla
            if (!Storage::disk('public')->exists('branch')) {
                Storage::disk('public')->makeDirectory('branch');
            }

            // Eliminar la imagen anterior si existe
            if ($branch->photo) {
                Storage::disk('public')->delete($branch->photo);
            }

            // Guardar la nueva imagen
            $file = $request->file('photo');
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/branch', $filename);

            // Actualizar la ruta de la imagen en los datos validados
            $validatedData['photo'] = 'branch/' . $filename;
        }

        // Actualizar los datos de la sucursal
        $branch->update($validatedData);
        return response()->json($branch);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch->update(['status' => 'eliminado']);
        return response()->json(null, 204);
    }
}
