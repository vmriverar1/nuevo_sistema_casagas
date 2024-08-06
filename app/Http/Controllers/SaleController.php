<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Historial;
use App\Models\PettyCash;
use Illuminate\Support\Str;
use App\Helpers\CashhHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::all();
        return response()->json($sales);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required|string|in:in process,charged,cancelled,deleted',
            'customer_id' => 'required|exists:users,id',
            'seller_id' => 'required|exists:users,id',
            'net_amount' => 'required|numeric',
            'discount' => 'required|numeric',
            'accounting_document_id' => 'required|exists:accounting_documents,id',
            'total' => 'required|numeric',
            'change' => 'required|numeric',
            'branch_id' => 'required|exists:branches,id',
            'petty_cashes_id' => 'required|exists:petty_cashes,id',
        ]);

        $sale = Sale::create($validatedData);

        return response()->json($sale, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return response()->json($sale);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        $validatedData = $request->validate([
            'status' => 'string|in:in process,charged,cancelled,deleted',
            'customer_id' => 'exists:users,id',
            'seller_id' => 'exists:users,id',
            'net_amount' => 'numeric',
            'discount' => 'numeric',
            'accounting_document_id' => 'exists:accounting_documents,id',
            'total' => 'numeric',
            'change' => 'numeric',
            'branch_id' => 'exists:branches,id',
            'petty_cashes_id' => 'exists:petty_cashes,id',
        ]);

        $sale->update($validatedData);

        return response()->json($sale);
    }

    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Request $request, Sale $sale)
    {
        // Iniciar una transacción de base de datos
        DB::beginTransaction();

        try {
            // Obtener los datos de la venta
            $saleData = $sale->load(['customer', 'products', 'accountingDocument', 'advances', 'plate', 'discounts'])->toArray();

            // Registrar en el historial
            Historial::create([
                'modulo' => 'ventas',
                'responsable' => Auth::id(),
                'data' => json_encode($saleData),
                'razon' => $request->input('motivo_anulacion', 'Sin razón especificada'),
            ]);

            // Cambiar el estado de la venta a 'cancelled'
            $sale->update(['status' => 'cancelled']);

            // Devolver el stock de los productos
            foreach ($sale->products as $product) {
                CashhHelper::devolverStock($product);
            }

            // Devolver el dinero a la caja
            $caja = PettyCash::find($sale->petty_cashes_id);
            if ($sale->status == 'in_parts' || $sale->status == 'in_process' || $sale->status == 'charged') {
                $caja->income -= $sale->total;
                $caja->save();
            }

            // Confirmar la transacción
            DB::commit();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
