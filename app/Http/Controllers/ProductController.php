<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Helpers\PhotoHelper;
use App\Helpers\TableHelper;
use Illuminate\Http\Request;
use App\Helpers\BranchHelper;
use App\Helpers\ProductHelper;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Requirement;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function page()
    {
        $marcas = Brand::all();
        $categorias = Category::all();
        $branch = BranchHelper::getBranchIdFromSession();
        $requerimientos = Requirement::all();
        $productos = Product::where('branch_id', $branch->id)
                            ->whereIn('type', ['producto'])
                            ->get();
        $servicios = Product::where('branch_id', $branch->id)
                            ->whereIn('type', ['servicio'])
                            ->get();
        $paquetes = Product::where('branch_id', $branch->id)
                            ->whereIn('type', ['paquete'])
                            ->get();
        $tiendas = Branch::all();

        $todosLosProductos = Product::select('id', 'name')->get();
        $dataProductos = $todosLosProductos->unique('name');

        return view('/productos',compact(['marcas','categorias','requerimientos','productos','servicios','tiendas','dataProductos']));
    }

    public function changeStatus(Request $request)
    {
        $productId = $request->input('product_id');
        $status = $request->input('status');

        $product = Product::find($productId);

        if ($product) {
            if ($status == 'activo') {
                $newStatus = 'inactivo';
            } else {
                $newStatus = 'activo';
            }

            // Actualizar el estado del producto
            $product->status = $newStatus;
            $product->save();

            // Generar el nuevo HTML del botón
            $btn_html = TableHelper::formatStatus("product", $newStatus, $product->id);

            return response()->json(['newBtn' => $btn_html]);
        }

        return response()->json(['error' => 'Producto no encontrado'], 404);
    }

    public function moveProducts(Request $request)
    {
        $branch = BranchHelper::getBranchIdFromSession();
        $my_branch = $branch->id;
        $destiny_branch = $request->branch_id;
        $productosMove = json_decode($request->productos_move, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            foreach ($productosMove as $prod) {
                $id_prod = $prod['id'];
                $cantidad = $prod['quantity'];

                $product = Product::where('id', $id_prod)->where('branch_id', $my_branch)->first();

                if ($product) {
                    // Restar la cantidad al stock del producto en la sucursal actual
                    if ($product->stock >= $cantidad) {
                        $product->stock -= $cantidad;
                        $product->save();
                    } else {
                        return response()->json(['status' => 'error', 'message' => 'Stock insuficiente en la sucursal actual'], 400);
                    }

                    // Buscar si el producto ya existe en la sucursal de destino por código de barras
                    $existingProduct = Product::where('barcode', $product->barcode)
                        ->where('branch_id', $destiny_branch)
                        ->first();

                    // Si no se encuentra por código de barras, buscar por nombre
                    if (!$existingProduct) {
                        $existingProduct = Product::where('name', $product->name)
                            ->where('branch_id', $destiny_branch)
                            ->first();
                    }

                    if ($existingProduct) {
                        // Sumar al stock existente en la sucursal de destino
                        $existingProduct->stock += $cantidad;
                        $existingProduct->save();
                    } else {
                        // Crear el producto en la sucursal de destino
                        $newProduct = $product->replicate();
                        $newProduct->branch_id = $destiny_branch;
                        $newProduct->stock = $cantidad;
                        $newProduct->save();

                        // Guardar las categorías del producto en la tabla intermedia
                        foreach ($product->categories as $category) {
                            $newProduct->categories()->attach($category->id);
                        }

                        // Guardar los requerimientos del producto en la tabla intermedia
                        foreach ($product->requirements as $requirement) {
                            $newProduct->requirements()->attach($requirement->id);
                        }

                        // Guardar los productos en paquete en la tabla intermedia
                        foreach ($product->productsInPackage as $packageProduct) {
                            $newProduct->productsInPackage()->attach($packageProduct->id, [
                                'quantity' => $packageProduct->pivot->quantity
                            ]);
                        }
                    }
                }
            }
        }

        return response()->json(['status' => 'success'], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branch = BranchHelper::getBranchIdFromSession();
        $products = Product::where('branch_id', $branch->id)->get();
        $products->transform(function($product) {
            $product->photo = PhotoHelper::formatPhoto("product", $product->photo);
            $product->status = TableHelper::formatStatus("product", $product->status, $product->id);
            $product->stock = ProductHelper::formatStock($product);
            $product->category_btns = ProductHelper::formatCategories($product->categories);
            $product->sale_price = 'S/.' . $product->sale_price;
            if($product->brand_id == null){
                $product->brand_id = '--';
            }else{
                $brand = Brand::findOrFail($product->brand_id);
                $product->brand_id = ProductHelper::formatBrand($brand);
            }
            return $product;
        });

        // Log::info('Producto encontrado:'. print_r($products,true));
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'requirements' => 'required|array',
            'requirements.*' => 'exists:requirements,id',
            'stock' => 'required|numeric',
            'minimum' => 'nullable|integer',
            'purchase_price' => 'nullable|numeric',
            'sale_price' => 'nullable|numeric',
            'barcode' => 'nullable|string|max:255',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
        ]);

        $branch = BranchHelper::getBranchIdFromSession();
        $validatedData['branch_id'] = $branch->id;
        $validatedData['photo'] = PhotoHelper::submitPhoto('product', $request);
        if ($validatedData['barcode'] == null) {
            $validatedData['barcode'] =  "";
        }

        $product = Product::create($validatedData);

        // Guardar las categorías del producto en la tabla intermedia
        foreach ($request->categories as $categoryId) {
            $product->categories()->attach($categoryId);
        }

        // Guardar los requerimientos del producto en la tabla intermedia
        foreach ($request->requirements as $requirementId) {
            $product->requirements()->attach($requirementId);
        }

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->categories =  $product->categories;
        $product->requirements =  $product->requirements;
        $product->productsInPackage = $product->productsInPackage;
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'requirements' => 'required|array',
            'requirements.*' => 'exists:requirements,id',
            'stock' => 'required|numeric',
            'minimum' => 'nullable|integer',
            'purchase_price' => 'nullable|numeric',
            'sale_price' => 'nullable|numeric',
            'barcode' => 'nullable|string|max:255',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
        ]);

        $branch = BranchHelper::getBranchIdFromSession();
        $validatedData['photo'] = PhotoHelper::updatePhoto($product, 'product', $request);

        if ($validatedData['barcode'] == null) {
            $validatedData['barcode'] =  "";
        }

        $product->update($validatedData);

        // ===============================================
        // CATEGORIAS
        // ===============================================

        $existingCategoryIds = $product->categories->pluck('id')->toArray();
        $newCategoryIds = $request->categories;

        $categoriesToAdd = array_diff($newCategoryIds, $existingCategoryIds);
        $categoriesToRemove = array_diff($existingCategoryIds, $newCategoryIds);

        $product->categories()->detach($categoriesToRemove);
        $product->categories()->attach($categoriesToAdd);

        // ===============================================
        // REQUERIMIENTOS
        // ===============================================

        $existingRequirementIds = $product->requirements->pluck('id')->toArray();
        $newRequirementIds = $request->requirements;

        $requirementsToAdd = array_diff($newRequirementIds, $existingRequirementIds);
        $requirementsToRemove = array_diff($existingRequirementIds, $newRequirementIds);

        $product->requirements()->detach($requirementsToRemove);
        $product->requirements()->attach($requirementsToAdd);

        // ===============================================
        // PAQUETE
        // ===============================================

        if($request->type === "paquete"){
            $productosKit = json_decode($request->productos_kit, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                // Obtener los IDs y cantidades actuales de productos en el paquete
                $existingProductsInPackage = $product->productsInPackage->keyBy('id')->toArray();

                $productsToAddOrUpdate = [];
                $productsToRemove = array_keys($existingProductsInPackage);

                foreach ($productosKit as $producto) {
                    if (isset($existingProductsInPackage[$producto['id']])) {
                        // Si el producto ya existe, verificar si hay cambios en la cantidad
                        if ($existingProductsInPackage[$producto['id']]['pivot']['quantity'] != $producto['quantity']) {
                            $productsToAddOrUpdate[$producto['id']] = ['quantity' => $producto['quantity']];
                        }
                        // Remover el producto de la lista de productos a eliminar
                        unset($productsToRemove[array_search($producto['id'], $productsToRemove)]);
                    } else {
                        // Si el producto no existe, agregarlo
                        $productsToAddOrUpdate[$producto['id']] = ['quantity' => $producto['quantity']];
                    }
                }

                // Agregar o actualizar productos en el paquete
                if (!empty($productsToAddOrUpdate)) {
                    $product->productsInPackage()->syncWithoutDetaching($productsToAddOrUpdate);
                }

                // Eliminar productos que ya no están en el paquete
                if (!empty($productsToRemove)) {
                    $product->productsInPackage()->detach($productsToRemove);
                }
            }
        }

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
