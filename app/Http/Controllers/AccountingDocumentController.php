<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\BranchHelper;
use App\Models\AccountingDocument;
use Illuminate\Support\Facades\Log;

class AccountingDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = AccountingDocument::all();
        return response()->json($documents);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Definir los mensajes de error personalizados
        $messages = [
            'name.required' => 'El nombre del documento contable es obligatorio.',
            'name.string' => 'El nombre del documento contable debe ser una cadena de texto.',
            'name.max' => 'El nombre del documento contable no debe ser mayor que 255 caracteres.',
            'electronic_billing.required' => 'La facturación electrónica es obligatoria.',
            'electronic_billing.boolean' => 'La facturación electrónica debe ser verdadero o falso.',
            'tax_type.required' => 'El tipo de impuesto es obligatorio.',
            'tax_type.in' => 'El tipo de impuesto debe ser "included in the price" o "add to the price".',
            'sale_percentage.required' => 'El porcentaje de venta es obligatorio.',
            'sale_percentage.numeric' => 'El porcentaje de venta debe ser un número.',
            'print_document.required' => 'El documento de impresión es obligatorio.',
            'print_document.string' => 'El documento de impresión debe ser una cadena de texto.',
            'print_document.max' => 'El documento de impresión no debe ser mayor que 255 caracteres.',
            'prefix_numbering.required' => 'El prefijo de numeración es obligatorio.',
            'prefix_numbering.string' => 'El prefijo de numeración debe ser una cadena de texto.',
            'prefix_numbering.max' => 'El prefijo de numeración no debe ser mayor que 255 caracteres.',
            'start_numbering.required' => 'El inicio de numeración es obligatorio.',
            'mail_shipping.required' => 'El envío por correo es obligatorio.',
            'mail_shipping.boolean' => 'El envío por correo debe ser verdadero o falso.',
        ];

        $branch = BranchHelper::getBranchIdFromSession();
        $request->merge(['electronic_billing' => $request->filled('electronic_billing') == 1 ? true : false]);
        $request->merge(['mail_shipping' => $request->filled('electronic_billing') == 1 ? true : false]);

        // Validar la solicitud
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'electronic_billing' => 'required|boolean',
                'tax_type' => 'required|string|in:in_price,out_price',
                'sale_percentage' => 'required|numeric',
                'print_document' => 'required|string|max:255',
                'prefix_numbering' => 'required|string|max:255',
                'start_numbering' => 'required',
                'mail_shipping' => 'required|boolean',
            ], $messages);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        // Crear el documento contable
        try {
            $validatedData['branch_id'] = $branch->id;
            $document = AccountingDocument::create($validatedData);
            return response()->json($document, 201);
        } catch (\Exception $e) {
            Log::error('Error al crear el documento contable: ' . $e->getMessage());
            return response()->json(['error' => 'Error al crear el documento contable.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AccountingDocument $accountingDocument)
    {
        return response()->json($accountingDocument);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AccountingDocument $accountingDocument)
    {
        // Definir los mensajes de error personalizados
        $messages = [
            'name.string' => 'El nombre del documento contable debe ser una cadena de texto.',
            'name.max' => 'El nombre del documento contable no debe ser mayor que 255 caracteres.',
            'electronic_billing.boolean' => 'La facturación electrónica debe ser verdadero o falso.',
            'tax_type.string' => 'El tipo de impuesto debe ser una cadena de texto.',
            'tax_type.in' => 'El tipo de impuesto debe ser "included in the price" o "add to the price".',
            'sale_percentage.numeric' => 'El porcentaje de venta debe ser un número.',
            'print_document.string' => 'El documento de impresión debe ser una cadena de texto.',
            'prefix_numbering.string' => 'El prefijo de numeración debe ser una cadena de texto.',
            'prefix_numbering.max' => 'El prefijo de numeración no debe ser mayor que 255 caracteres.',
            'mail_shipping.boolean' => 'El envío por correo debe ser verdadero o falso.',
        ];

        $branch = BranchHelper::getBranchIdFromSession();
        $request->merge(['electronic_billing' => $request->filled('electronic_billing') == 1 ? true : false]);
        $request->merge(['mail_shipping' => $request->filled('electronic_billing') == 1 ? true : false]);

        // Validar la solicitud
        try {
            $validatedData = $request->validate([
                'name' => 'sometimes|string|max:255',
                'electronic_billing' => 'sometimes|boolean',
                'tax_type' => 'sometimes|string|in:included in the price,add to the price',
                'sale_percentage' => 'sometimes|numeric',
                'print_document' => 'sometimes|string',
                'prefix_numbering' => 'sometimes|string|max:255',
                'start_numbering' => 'sometimes',
                'mail_shipping' => 'sometimes|boolean',
            ], $messages);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        // Actualizar el documento contable
        try {
            $validatedData['branch_id'] = $branch->id;
            $accountingDocument->update($validatedData);
            return response()->json($accountingDocument);
        } catch (\Exception $e) {
            Log::error('Error al actualizar el documento contable: ' . $e->getMessage());
            return response()->json(['error' => 'Error al actualizar el documento contable.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccountingDocument $accountingDocument)
    {
        try {
            $accountingDocument->update(['status' => 'eliminado']);
            return response()->json(null, 204);
        } catch (\Exception $e) {
            Log::error('Error al eliminar el documento contable: ' . $e->getMessage());
            return response()->json(['error' => 'Error al eliminar el documento contable.'], 500);
        }
    }
}
