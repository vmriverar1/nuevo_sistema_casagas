<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use App\Models\Product;
use App\Models\Discount;
use App\Models\Purchase;
use App\Models\PettyCash;
use App\Models\UserPlate;
use App\Helpers\CashhHelper;
use Illuminate\Http\Request;
use App\Helpers\BranchHelper;
use App\Models\PaymentMethod;
use App\Helpers\ProductHelper;
use App\Models\AccountingDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CashController extends Controller
{
    public function page(Request $request)
    {
        // traemos el id del usuario autenticado
        $user = auth()->user();
        // traer todas kas cajas abiertas del usuario
        $cajas = PettyCash::where([['responsible_id', $user->id],['status', 'abierta']])->get();

        // si no hay ninfguna caja abierta redireccionamos
        if ($cajas->count() == 0) {
            return view('/abrir_caja');
        }

        // dejamos solo una caja y las mas antigua las cerramos
        // ====================================================
        foreach ($cajas as $caja) {
            if ($caja->id != $cajas->last()->id) {
                $caja->status = 'cerrada';
                $caja->save();
            }
        }

        $branch = BranchHelper::getBranchIdFromSession();
        $ventas = Sale::where('branch_id', $branch->id)
                        ->whereNotIn('status', ['cancelled', 'deleted'])
                        ->with('customer')
                        ->get();
        $compras = Purchase::where('branch_id', $branch->id)
                        ->whereNotIn('status', ['cancelled', 'deleted'])
                        ->with('supplier')
                        ->get();
        $descuentos = Discount::where('branch_id', $branch->id)->get();
        $documentos = AccountingDocument::where('branch_id', $branch->id)->get();
        $pagos = PaymentMethod::where('branch_id', $branch->id)->with('requirements')->get();

        $servicios = Product::where('branch_id', $branch->id)
                            ->whereIn('type', ['servicio'])
                            ->get();
        $paquetes = Product::where('branch_id', $branch->id)
                            ->whereIn('type', ['paquete'])
                            ->get();

        return view('/caja',compact(['ventas','compras', 'pagos','documentos','descuentos','caja']));
    }

    public function buscarCliente($document)
    {
        $user = User::where('document', $document)->with('plates')->first();

        if (!$user) {
            return response()->json([], 404);
        }

        $ventas = Sale::where('customer_id', $user->id)->with('customer')->get()->toArray();
        $compras = Purchase::where('supplier_id', $user->id)->with('supplier')->get()->toArray();

        foreach ($ventas as &$venta) {
            $venta['type'] = 'venta';
        }

        foreach ($compras as &$compra) {
            $compra['type'] = 'compra';
        }

        $resultados = array_merge($ventas, $compras);

        usort($resultados, function ($a, $b) {
            return strtotime($b['updated_at']) - strtotime($a['updated_at']);
        });

        return response()->json($resultados);
    }

    public function traerVentasActivas()
    {
        $branch = BranchHelper::getBranchIdFromSession();
        $ventas = Sale::where('branch_id', $branch->id)
                        ->whereNotIn('status', ['cancelled', 'deleted'])
                        ->with('customer')
                        ->get();

        // Añadir el atributo type a cada venta
        $ventas = $ventas->map(function ($venta) {
            $venta->type = 'venta';
            return $venta;
        });

        return response()->json($ventas);
    }

    public function buscarVenta($document)
    {
        try {
            $branch = BranchHelper::getBranchIdFromSession();

            if ($document === "vacio") {
                $ventas = Sale::where('branch_id', $branch->id)
                    ->whereNotIn('status', ['cancelled', 'deleted'])
                    ->with('customer')
                    ->get();
            } else {
                $ventas = collect(); // Iniciar una colección vacía para las ventas

                if (ctype_digit($document)) {
                    $user = User::where('document', $document)->first();

                    if ($user) {
                        $ventas = Sale::where('customer_id', $user->id)
                            ->whereNotIn('status', ['cancelled', 'deleted'])
                            ->with('customer')
                            ->get();
                    }
                } else {
                    $userPlate = UserPlate::where('plate_number', $document)->first();

                    if ($userPlate) {
                        $ventas = Sale::where('customer_id', $userPlate->user_id)
                            ->whereNotIn('status', ['cancelled', 'deleted'])
                            ->with('customer')
                            ->get();
                    }
                }

                // Si no se encontraron ventas, retornar respuesta vacía
                if ($ventas->isEmpty()) {
                    return response()->json([], 404);
                }
            }

            // Añadir el atributo type a cada venta
            $ventas = $ventas->map(function ($venta) {
                $venta->type = 'venta';
                return $venta;
            });

            return response()->json($ventas);
        } catch (\Exception $e) {
            Log::error('Error buscando ventas: ' . $e->getMessage());

            // En caso de error, retornar todas las ventas disponibles
            $ventas = Sale::where('branch_id', $branch->id)
                ->whereNotIn('status', ['cancelled', 'deleted'])
                ->with('customer')
                ->get();

            // Añadir el atributo type a cada venta
            $ventas = $ventas->map(function ($venta) {
                $venta->type = 'venta';
                return $venta;
            });

            return response()->json($ventas);
        }
    }


    public function traerVenta($venta_id)
    {
        $sale = Sale::with(['customer', 'seller', 'products', 'accountingDocument','advances','plate','discounts'])->findOrFail($venta_id);
        return response()->json($sale);
    }

    public function traerCompra($compra_id)
    {
        $purchase = Purchase::with(['supplier', 'products', 'accountingDocument'])->findOrFail($compra_id);
        return response()->json($purchase);
    }

    public function buscarCompra($document)
    {
        if ($document === "vacio") {
            $branch = BranchHelper::getBranchIdFromSession();
            $compras = Purchase::where('branch_id', $branch->id)->with('supplier')->get();
        }else{
            $user = User::where('document', $document)->first();
            if (!$user) {
                return response()->json([], 404);
            }
            $compras = Purchase::where('supplier_id', $user->id)->with('supplier')->get();
        }

        // Añadir el atributo type a cada venta
        $compras = $compras->map(function ($compra) {
            $compra->type = 'compra';
            return $compra;
        });

        return response()->json($compras);
    }

    // ===========================================
    // BUSQUEDA DE PRODUCTOS
    // ===========================================

    public function buscarProductosSelect(Request $request)
    {
        $search = $request->get('q');
        $productos = Product::where('name', 'LIKE', "%{$search}%")->get(['id', 'name']);
        return response()->json($productos);
    }

    public function buscarProductosTodos(Request $request)
    {
        $search = $request->get('q');

        $productos = Product::where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('barcode', 'LIKE', "%{$search}%")
                      ->orWhereHas('brand', function ($query) use ($search) {
                          $query->where('name', 'LIKE', "%{$search}%");
                      })
                      ->orWhereHas('categories', function ($query) use ($search) {
                          $query->where('name', 'LIKE', "%{$search}%");
                      });
            })
            ->take(5)
            ->get(['id', 'name']);

        return response()->json($productos);
    }

    public function buscarProductos(Request $request)
    {
        $branch = BranchHelper::getBranchIdFromSession();
        $search = $request->input('search');

        $productos = Product::where('branch_id', $branch->id)
                            ->where('type', 'producto')
                            ->where('status', 'activo')
                            ->where(function ($query) use ($search) {
                                $query->where('name', 'LIKE', "%{$search}%")
                                      ->orWhere('barcode', 'LIKE', "%{$search}%")
                                      ->orWhereHas('brand', function ($query) use ($search) {
                                          $query->where('name', 'LIKE', "%{$search}%");
                                      })
                                      ->orWhereHas('categories', function ($query) use ($search) {
                                          $query->where('name', 'LIKE', "%{$search}%");
                                      });
                            })
                            ->paginate(12);

        return response()->json([
            'products' => $productos->items(),
            'pagination' => [
                'total' => $productos->total(),
                'current_page' => $productos->currentPage(),
                'last_page' => $productos->lastPage(),
            ],
        ]);
    }

    public function buscarServicios(Request $request)
    {
        $branch = BranchHelper::getBranchIdFromSession();
        $search = $request->input('search');

        $servicios = Product::where('branch_id', $branch->id)
                            ->where('type', 'servicio')
                            ->where('status', 'activo')
                            ->where(function ($query) use ($search) {
                                $query->where('name', 'LIKE', "%{$search}%")
                                    ->orWhere('barcode', 'LIKE', "%{$search}%")
                                    ->orWhereHas('brand', function ($query) use ($search) {
                                        $query->where('name', 'LIKE', "%{$search}%");
                                    })
                                    ->orWhereHas('categories', function ($query) use ($search) {
                                        $query->where('name', 'LIKE', "%{$search}%");
                                    });
                            })
                            ->paginate(12);

        return response()->json([
            'products' => $servicios->items(),
            'pagination' => [
                'total' => $servicios->total(),
                'current_page' => $servicios->currentPage(),
                'last_page' => $servicios->lastPage(),
            ],
        ]);
    }

    public function buscarPaquetes(Request $request)
    {
        $branch = BranchHelper::getBranchIdFromSession();
        $search = $request->input('search');

        $paquetes = Product::where('branch_id', $branch->id)
                        ->where('type', 'paquete')
                        ->where('status', 'activo')
                        ->where(function ($query) use ($search) {
                                $query->where('name', 'LIKE', "%{$search}%")
                                    ->orWhere('barcode', 'LIKE', "%{$search}%")
                                    ->orWhereHas('brand', function ($query) use ($search) {
                                        $query->where('name', 'LIKE', "%{$search}%");
                                    })
                                    ->orWhereHas('categories', function ($query) use ($search) {
                                        $query->where('name', 'LIKE', "%{$search}%");
                                    });
                            })
                        ->paginate(12);

        $paquetes->transform(function($producto) {
            $producto->stock = ProductHelper::buildPack($producto);
            return $producto;
        });

        return response()->json([
            'products' => $paquetes->items(),
            'pagination' => [
                'total' => $paquetes->total(),
                'current_page' => $paquetes->currentPage(),
                'last_page' => $paquetes->lastPage(),
            ],
        ]);
    }

    public function obtenerProducto($id)
    {
        $producto = Product::with('requirements')->findOrFail($id);

        if($producto->type === 'producto'){
        }else if($producto->type === 'servicio'){
            $producto->stock = PHP_INT_MAX;
        }else if($producto->type === 'paquete'){
            $producto->stock = ProductHelper::buildPack($producto);
        }

        return response()->json($producto);
    }

    // Método para buscar cliente por documento
    public function buscarClienteDetalle($document)
    {
        $cliente = User::where('document', $document)->with('plates')->first();

        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        return response()->json($cliente);
    }

    public function hacerVenta(Request $request)
    {
        try {
            $user = auth()->user();
            $caja = PettyCash::where([['responsible_id', $user->id],['status', 'abierta']])->first();
            $branch = BranchHelper::getBranchIdFromSession();
            $request['branch_id'] = $branch->id;
            $request['petty_cashes_id'] = $caja->id;

            // Comprobamos los request
            $new_request = CashhHelper::gestion_data_request($request);

            // Validamos los datos
            $validatedData = $new_request->validate([
                'status' => 'required|in:in_process,in_parts,charged,cancelled,deleted',
                'amount' => 'required|numeric|min:0',
                'tax' => 'required|numeric|min:0',
                'discount' => 'required|numeric|min:0',
                'total' => 'required|numeric|min:0',
                'change' => 'required|numeric|min:0',
                'branch_id' => 'required|exists:branches,id',
                'petty_cashes_id' => 'required|exists:petty_cashes,id',
            ]);

            // Detectamos los documentos de cliente
            $cliente = CashhHelper::gestion_cliente($new_request);
            Log::info('Cliente detectado.', ['cliente_id' => $cliente->id]);

            // Número de documento
            if (AccountingDocument::where('branch_id', $branch->id)->exists()) {
                $document_code = CashhHelper::gestion_boleta($new_request["document_sale"]);
                Log::info('Código de documento generado: ', ['document_code' => $document_code]);
            }

            // calculamos el monto de la venta
            $monto = CashhHelper::calcular_monto_venta($new_request);
            $total = CashhHelper::calcular_total_venta($new_request, $monto);
            Log::info('Monto y total calculados.', ['monto' => $monto, 'total' => $total]);

            // Crear la venta
            $venta = Sale::create([
                'status' => $validatedData['status'],
                'customer_id' => $cliente->id ?? null,
                'seller_id' => auth()->id(),
                'amount' => $monto,
                'tax' => $validatedData['tax'],
                'discount' => $validatedData['discount'],
                'accounting_document_id' => $new_request['document_sale'] ?? null,
                'accounting_document_code' => $document_code ?? "Ninguno",
                'total' => $total,
                'change' => $validatedData['change'],
                'branch_id' => $validatedData['branch_id'],
                'petty_cashes_id' => $validatedData['petty_cashes_id'],
                'plate_id' => $cliente->plate_id ?? null,
            ]);
            Log::info('Venta creada exitosamente.', ['venta_id' => $venta->id]);

            // Actualizar productos
            CashhHelper::gestion_producto($new_request, $venta->id);
            Log::info('Productos gestionados para la venta.', ['venta_id' => $venta->id]);

            // Manejamos el adelanto de existir uno
            CashhHelper::gestion_adelanto($new_request, $venta->id, $caja);
            Log::info('Adelantos gestionados para la venta.', ['venta_id' => $venta->id]);

            // Manejamos el descuento
            if (Discount::where('branch_id', $branch->id)->exists()) {
                CashhHelper::gestion_descuento($new_request, $venta->id);
                Log::info('Descuentos gestionados para la venta.', ['venta_id' => $venta->id]);
            }

            // Manejamos la forma de pago
            if (PaymentMethod::where('branch_id', $branch->id)->exists()) {
                CashhHelper::gestion_metodo_pago($new_request, $venta->id);
                Log::info('Métodos de pago gestionados para la venta.', ['venta_id' => $venta->id]);
            }

            // return response()->json(['error' => 'Error al hacer la venta.'], 500);
            return response()->json(['venta' => $venta], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Error de validación al hacer la venta.', ['errors' => $e->errors()]);
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error al hacer la venta: ' . $e->getMessage());
            return response()->json(['error' => 'Error al hacer la venta.'], 500);
        }
    }

    public function editarVenta(Request $request, Sale $venta)
    {
        try {
            DB::beginTransaction();

            $branch = BranchHelper::getBranchIdFromSession();
            $request['branch_id'] = $branch->id;
            $request['petty_cashes_id'] = $venta->petty_cashes_id;
            $caja = PettyCash::find($venta->petty_cashes_id);

            // Traemos los productos actuales de la venta
            $sale = Sale::with(['products'])->findOrFail($venta->id);

            // Comprobamos los request
            $new_request = CashhHelper::gestion_data_request($request);

            // Validamos los datos
            $validatedData = $new_request->validate([
                'status' => 'required|in:in_process,in_parts,charged,cancelled,deleted',
                'amount' => 'required|numeric|min:0',
                'tax' => 'required|numeric|min:0',
                'discount' => 'required|numeric|min:0',
                'total' => 'required|numeric|min:0',
                'change' => 'required|numeric|min:0',
                'branch_id' => 'required|exists:branches,id',
                'petty_cashes_id' => 'required|exists:petty_cashes,id',
            ]);

            // Llamamos al helper para gestionar los productos
            CashhHelper::gestion_producto_editar($sale, $new_request);
            Log::info('Productos gestionados para la venta.', ['venta_id' => $venta->id]);

            // Manejamos el descuento si existe
            if (Discount::where('branch_id', $branch->id)->exists()) {
                CashhHelper::gestion_descuento($new_request, $venta->id);
                Log::info('Descuentos gestionados para la venta.', ['venta_id' => $venta->id]);
            }

            $monto = CashhHelper::calcular_monto_venta($new_request);
            $total = CashhHelper::calcular_total_venta($new_request, $monto, $venta->id);
            Log::info('Monto y total calculados.', ['monto' => $monto, 'total' => $total]);

            // Manejamos el adelanto de existir uno
            CashhHelper::gestion_adelanto($new_request, $venta->id, $caja);
            Log::info('Adelantos gestionados para la venta.', ['venta_id' => $venta->id]);

            // Actualizamos el discount y el total en venta
            $venta->discount = $validatedData['discount'];
            $venta->status = $validatedData['status'];
            $venta->amount = $monto;
            $venta->total = $total;

            if ($venta->status == 'in_parts' && $total == 0) {
                $venta->status = 'charged';
                $venta->total = $monto  + $new_request["tax"] - $new_request["discount"] - $new_request["money_advance"];
            }


            $venta->save();
            Log::info('Venta actualizada exitosamente.', ['venta_id' => $venta->id]);

            DB::commit();

            return response()->json($venta, 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::error('Error de validación al editar la venta.', ['errors' => $e->errors()]);
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al editar la venta: ' . $e->getMessage());
            return response()->json(['error' => 'Error al editar la venta.'], 500);
        }
    }

    public function productosVenta(Request $request, Sale $venta)
    {
        try {
            DB::beginTransaction();

            $branch = BranchHelper::getBranchIdFromSession();
            $request['branch_id'] = $branch->id;
            $request['petty_cashes_id'] = $venta->petty_cashes_id;

            // Traemos los productos actuales de la venta
            $sale = Sale::with(['products'])->findOrFail($venta->id);

            // Comprobamos los request
            $new_request = CashhHelper::gestion_data_request($request);

            // Validamos los datos
            $validatedData = $new_request->validate([
                'status' => 'required|in:in_process,in_parts,charged,cancelled,deleted',
                'amount' => 'required|numeric|min:0',
                'tax' => 'required|numeric|min:0',
                'discount' => 'required|numeric|min:0',
                'total' => 'required|numeric|min:0',
                'change' => 'required|numeric|min:0',
                'branch_id' => 'required|exists:branches,id',
                'petty_cashes_id' => 'required|exists:petty_cashes,id',
            ]);

            // Llamamos al helper para gestionar los productos
            CashhHelper::gestion_producto_editar($sale, $new_request);
            Log::info('Productos gestionados para la venta.', ['venta_id' => $venta->id]);

            // Calcular el monto y el total de la venta
            $monto = CashhHelper::calcular_monto_venta($new_request);
            $total = CashhHelper::calcular_total_venta($new_request, $monto, $venta->id);
            Log::info('Monto y total calculados.', ['monto' => $monto, 'total' => $total]);

            // Actualizamos el discount y el total en venta
            $venta->amount = $monto;
            $venta->total = $total;
            $venta->save();
            Log::info('Venta actualizada exitosamente.', ['venta_id' => $venta->id]);

            DB::commit();

            return response()->json($venta, 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::error('Error de validación al actualizar los productos de la venta.', ['errors' => $e->errors()]);
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar los productos de la venta: ' . $e->getMessage());
            return response()->json(['error' => 'Error al actualizar los productos de la venta.'], 500);
        }
    }
}
