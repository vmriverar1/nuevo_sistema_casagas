<?php

namespace App\Helpers;


use App\Models\User;
use App\Models\Product;
use App\Models\UserPlate;
use App\Models\AccountingDocument;
use App\Models\SaleAdvance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CashhHelper
{
    public static function gestion_cliente($request)
    {
        // validamos si ha llegado en el request un atrubuto name
        $cliente = User::where('document', $request["document_client"])->first();

        if (isset($request["name"]) && ! $cliente) {
            // ahora se guarda el cliente en la tabla de usuarios teniendo presente que podria llegar o no los atributos email y phone
            $validatedDataUser = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'nullable|string|max:255',
            ]);

            $validatedDataUser['document'] = $request['document_client'];
            $validatedDataUser['profile'] = "cliente";
            $validatedDataUser['password'] = Hash::make("password");

            if (! isset($request["email"])) {
                $validatedDataUser['email'] = $request['document'] . '@temporal.com';
            }else{
                $validatedDataUser['email'] = $request['email'];
            }

            $cliente = User::create($validatedDataUser);
        }

        if (isset($request["car_registration"])) {
            // buscamos si la placa existee con el controlador UserPlateController
            // $userPlate = UserPlate::where('plate_number', $request["car_registration"])->orWhere('id', $request["car_registration"])->first();
            $userPlate = UserPlate::where([
                ['plate_number', $request["car_registration"]],
                ['user_id', $cliente->id]
            ])->orWhere([
                ['id', $request["car_registration"]],
                ['user_id', $cliente->id]
            ])->first();
            // si no existe la placa se crea
            if (!$userPlate) {
                $userPlate = UserPlate::create([
                    'user_id' => $cliente->id,
                    'plate_number' => $request["car_registration"],
                ]);
            }

            // agregamos a $cliente el id de la placa
            $cliente->plate_id = $userPlate->id;
        }

        return $cliente;
    }

    public static function gestion_boleta($document_id)
    {
        // buscamos si el documento existe AccountingDocumentController
        $document = AccountingDocument::where('id', $document_id)->first();
        $prefix_numbering_sale = $document->prefix_numbering;
        $start_numbering_sale = $document->start_numbering;

        // creamos el codigo de la venta
        $accounting_document_code = $prefix_numbering_sale . '-' . str_pad($start_numbering_sale, 8, '0', STR_PAD_LEFT);

        // agragamos a start_numbering_sale una unidad y guardamos
        $document->start_numbering = $start_numbering_sale + 1;
        $document->save();

        return $accounting_document_code;
    }

    public static function gestion_data_request($request)
    {
        $cajaData = json_decode($request->input('caja'), true);
        $request["car_registration"] = preg_replace('/[^A-Za-z0-9]/', '', $request["car_registration"]);
        $request["status"] = $cajaData["status"];
        $request["customer_id"] = $cajaData["customer_id"];
        $request["amount"] = self::convertToDecimal($cajaData["amount"]);
        $request["total"] = self::convertToDecimal($cajaData["total"]);
        $request["accounting_document_id"] = $cajaData["customer_id"];
        // descuentos
        $request["discount"] = self::convertToDecimal($cajaData["discount"]);
        $request["discount_id"] = $cajaData["discount_id"];
        // impuestos
        $request["tax_id"] = $cajaData["tax_id"];
        $request["tax"] = self::convertToDecimal($cajaData["tax"]);
        // metodos de pago
        $request["payment_method"] = $cajaData["payment_method"];
        $request["payment_method_id"] = $cajaData["payment_method_id"];

        $request["products"] = $cajaData["products"];
        if ($request["status"] === "in_process") {
            $request["change"] = 0;
        }else{
            $request["change"] = self::convertToDecimal($cajaData["change"]);
        }

        return $request;
    }

    private static function convertToDecimal($value)
    {
        if (is_string($value)) {
            // Remover las comas y convertir a float
            $value = str_replace(',', '', $value);
            return number_format((float) $value, 2, '.', '');
        }
        return number_format((float) $value, 2, '.', '');
    }

    public static function gestion_producto($request, $saleId)
    {
        // itereamos el request products
        foreach ($request["products"] as $product) {

            // buscamos si el producto existe
            $producto = Product::where('id', $product["id"])->first();
            $requerimientos = $producto->requirements;
            $quantity = $product["quantity"];

            if ($producto->type == "producto") {
                $new_stock = $producto->stock - $quantity;
                $producto->stock = $new_stock;
                $product_saved = $producto->save();
            }else if($producto->type == "paquete"){
                $procuctos_in_package = $product["products_in_package"];

                foreach ($procuctos_in_package as $product) {
                    // traemos el producto del paquete
                    $product_pack = Product::where('id', $product["id"])->first();
                    $new_stock = $product_pack->stock - $quantity;
                    $product_pack->stock = $new_stock;
                    $product_saved = $product_pack->save();
                    // hacemos un log del producto guardado
                    Log::warning("El paquete guardado es {$product_saved}");
                }
            }

            // hacemos un log del producto guardado
            Log::warning("El producto guardado es {$product_saved}");

            // GUARDAMOS LOS ARCHIVOS DE LOS PRODUCTOS

            $requerimientoFields = array_filter($request->files->keys(), function ($key) {
                return strpos($key, 'requerimiento_') === 0;
            });

            $fileUrl = null;

            foreach ($requerimientoFields as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $productName = substr($field, strlen('requerimiento_'));
                    Log::warning("El nombre de producto es {$productName}");
                    // Comparamos el nombre del producto
                    foreach ($requerimientos as $requerimiento) {
                        if ($requerimiento->name == $productName) {
                            // Guardamos el archivo en el servidor
                            $path = "requerimientos/productos/{$productName}";
                            $filePath = $file->storeAs($path, $file->getClientOriginalName(), 'public');
                            $fileUrl = Storage::url($filePath);
                        }
                    }
                }
            }

            // GUARDAMOS  LOS PRODUCTOS DE LA VENTA

            DB::table('sale_products')->insert([
                'sale_id' => $saleId,
                'product_id' => $product["id"],
                'quantity' => $quantity,
                'url' => $fileUrl,
            ]);
        }
    }

    public static function gestion_adelanto($request, $sale_id)
    {
        if(isset($request["money_advance"]) && $request["money_advance"] > 0){
            SaleAdvance::create([
                'sale_id' => $sale_id,
                'advance_amount' => $request["money_advance"],
                'change' => $request["change"],
            ]);
        }
    }

    public static function gestion_descuento($request, $sale_id)
    {
        if(isset($request["discount_id"]) && ($request["discount_id"] > 0 || $request["discount_id"] != "ninguno")){
            DB::table('sale_discounts')->insert([
                'sale_id' => $sale_id,
                'discount_id' => $request["discount_id"],
                'total' => $request["discount"],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public static function gestion_metodo_pago($request, $sale_id)
    {
        if(isset($request["payment_method_id"]) && ($request["payment_method_id"] > 0 || $request["payment_method_id"] != "ninguno")){
            DB::table('sale_payment_methods')->insert([
                'sale_id' => $sale_id,
                'payment_method_id' => $request["payment_method_id"],
                'total' => $request["payment_method"],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
