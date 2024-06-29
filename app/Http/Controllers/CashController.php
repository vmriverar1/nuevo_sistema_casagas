<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use App\Models\Product;
use App\Models\Discount;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Helpers\BranchHelper;
use App\Helpers\CashhHelper;
use App\Models\PaymentMethod;
use App\Helpers\ProductHelper;
use App\Models\AccountingDocument;

class CashController extends Controller
{
    public function page(Request $request)
    {
        $branch = BranchHelper::getBranchIdFromSession();
        $ventas = Sale::where('branch_id', $branch->id)->with('customer')->get();
        $compras = Purchase::where('branch_id', $branch->id)->with('supplier')->get();
        $descuentos = Discount::where('branch_id', $branch->id)->get();
        $documentos = AccountingDocument::where('branch_id', $branch->id)->get();
        $pagos = PaymentMethod::where('branch_id', $branch->id)->with('requirements')->get();

        $servicios = Product::where('branch_id', $branch->id)
                            ->whereIn('type', ['servicio'])
                            ->get();
        $paquetes = Product::where('branch_id', $branch->id)
                            ->whereIn('type', ['paquete'])
                            ->get();

        return view('/caja',compact(['ventas','compras', 'pagos','documentos','descuentos']));
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

    public function buscarVenta($document)
    {
        if ($document === "vacio") {
            $branch = BranchHelper::getBranchIdFromSession();
            $ventas = Sale::where('branch_id', $branch->id)->with('customer')->get();
        }else{
            $user = User::where('document', $document)->first();
            if (!$user) {
                return response()->json([], 404);
            }
            $ventas = Sale::where('customer_id', $user->id)->with('customer')->get();
        }

        // Añadir el atributo type a cada venta
        $ventas = $ventas->map(function ($venta) {
            $venta->type = 'venta';
            return $venta;
        });

        return response()->json($ventas);
    }

    public function traerVenta($venta_id)
    {
        $sale = Sale::with(['customer', 'products', 'accountingDocument','advances','plate','discounts'])->findOrFail($venta_id);
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

    public function buscarProductos(Request $request)
    {
        $branch = BranchHelper::getBranchIdFromSession();
        $search = $request->input('search');

        $productos = Product::where('branch_id', $branch->id)
                            ->where('type', 'producto')
                            ->where('name', 'LIKE', "%{$search}%")
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

        $productos = Product::where('branch_id', $branch->id)
                            ->where('type', 'servicio')
                            ->where('name', 'LIKE', "%{$search}%")
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

    public function buscarPaquetes(Request $request)
    {
        $branch = BranchHelper::getBranchIdFromSession();
        $search = $request->input('search');

        $productos = Product::where('branch_id', $branch->id)
                            ->where('type', 'paquete')
                            ->where('name', 'LIKE', "%{$search}%")
                            ->paginate(12);
        $productos->transform(function($producto) {
            $producto->stock = ProductHelper::buildPack($producto);
            return $producto;
        });

        return response()->json([
            'products' => $productos->items(),
            'pagination' => [
                'total' => $productos->total(),
                'current_page' => $productos->currentPage(),
                'last_page' => $productos->lastPage(),
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
        $branch = BranchHelper::getBranchIdFromSession();
        $request['branch_id'] = $branch->id;
        $request['petty_cashes_id'] = '2';

        // comprobamos los request
        $new_request = CashhHelper::gestion_data_request($request);

        // validamos los datos
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

        // detectamos los documentos de cliente
        $cliente = CashhHelper::gestion_cliente($new_request);

        // numero de documento
        $document_code = CashhHelper::gestion_boleta($new_request["document_sale"]);

        // Crear la venta
        $venta = Sale::create([
            'status' => $validatedData['status'],
            'customer_id' => $cliente->id,
            'seller_id' => auth()->id(),
            'amount' => $validatedData['amount'],
            'tax' => $validatedData['tax'],
            'discount' => $validatedData['discount'],
            'accounting_document_id' => $new_request['document_sale'],
            'accounting_document_code' => $document_code,
            'total' => $validatedData['total'],
            'change' => $validatedData['change'],
            'branch_id' => $validatedData['branch_id'],
            'petty_cashes_id' => $validatedData['petty_cashes_id'],
            'plate_id' => $cliente->plate_id ?? null,
        ]);


        // Actualizar productos
        CashhHelper::gestion_producto($new_request, $venta->id);

        // manejamos el adelanto de existir uno
        CashhHelper::gestion_adelanto($new_request, $venta->id);

        // manejemos el descuento
        CashhHelper::gestion_descuento($new_request, $venta->id);

        // manejemos la forma de pago
        CashhHelper::gestion_metodo_pago($new_request, $venta->id);

        return response()->json(['venta' => $venta], 201);
    }

    // 48193275
}
