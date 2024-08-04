<?php

namespace App\Helpers;


use App\Models\User;
use App\Models\Product;
use App\Models\Discount;
use App\Models\PettyCash;
use App\Models\UserPlate;
use App\Models\SaleAdvance;
use App\Models\AccountingDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CashhHelper
{
    public static function gestion_cliente($request)
    {
        if($request["customer_name"] == "Anónimo"){
            $cliente = new User();
            $cliente->id = null;
            $cliente->name = $request["customer_name"];
            $cliente->document = "00000000";
            $cliente->email = "anonimo@gmail.com";
            $cliente->phone = "000000000";
            $cliente->profile = "cliente";
            return $cliente;
        }

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
        $request["customer_name"] = $cajaData["customer_name"];
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
        // pago
        $request["money_advance"] = self::convertToDecimal($cajaData["money_advance"]) ?? 0;

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

    // ================================================================
    // GESTIÓN DE PRODUCTOS EN VENTA
    // ================================================================

    public static function gestion_producto($request, $saleId)
    {
        self::executeTransaction(function () use ($request, $saleId) {
            foreach ($request["products"] as $product) {
                self::processProduct($product, $saleId, $request);
            }
        }, "Error gestionando productos en venta.");
    }

    public static function gestion_producto_editar($sale, $request)
    {
        self::executeTransaction(function () use ($sale, $request) {
            $existingProducts = $sale->products->keyBy('id');
            $newProducts = collect($request->products)->keyBy('id');

            Log::info("Los productos existentes son {$existingProducts}");
            Log::info("Los nuevos productos son {$newProducts}");

            foreach ($newProducts as $productId => $newProduct) {
                if ($existingProducts->has($productId)) {
                    $existingProduct = $existingProducts[$productId];
                    $quantityDifference = $newProduct['quantity'] - $existingProduct->pivot->quantity;
                    Log::info("La diferencia de cantidad es {$quantityDifference}");

                    $fileUrl = self::guardarRequerimientos($request, $existingProduct);
                    self::updateSaleProduct($sale->id, $productId, $newProduct['quantity'], $fileUrl);
                    self::actualizarStock($newProduct, $quantityDifference);

                    $existingProducts->forget($productId);
                } else {
                    self::agregarProducto($sale->id, $newProduct, $request);
                }
            }

            foreach ($existingProducts as $productId => $existingProduct) {
                self::devolverStock($existingProduct);
                self::deleteSaleProduct($sale->id, $productId);
            }
        }, "Error editando productos en venta.");
    }

    private static function processProduct($product, $saleId, $request)
    {
        self::actualizarStock($product);
        $fileUrl = self::guardarRequerimientos($request, $product);

        $existingSaleProduct = DB::table('sale_products')
            ->where('sale_id', $saleId)
            ->where('product_id', $product["id"])
            ->first();

        if ($existingSaleProduct) {
            self::updateSaleProduct($saleId, $product["id"], $existingSaleProduct->quantity + $product["quantity"], $fileUrl);
        } else {
            self::agregarProducto($saleId, $product, $request);
        }
    }

    private static function agregarProducto($saleId, $product, $request)
    {
        self::executeWithErrorHandling(function () use ($saleId, $product, $request) {
            self::actualizarStock($product);
            $fileUrl = self::guardarRequerimientos($request, $product);

            DB::table('sale_products')->insert([
                'sale_id' => $saleId,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'url' => $fileUrl,
            ]);
        }, "Error agregando producto.");
    }

    private static function guardarRequerimientos($request, $product)
    {
        // detecta si product es un array y convierte a objeto
        if (is_array($product)) {
            $product = (object) $product;
        }

        return self::executeWithErrorHandling(function () use ($request, $product) {
            $requerimientos = $product->requirements;
            $requerimientoFields = array_filter($request->files->keys(), function ($key) {
                return strpos($key, 'requerimiento_') === 0;
            });

            $fileUrl = null;

            foreach ($requerimientoFields as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $productName = substr($field, strlen('requerimiento_'));
                    Log::warning("El nombre de producto es {$productName}");

                    foreach ($requerimientos as $requerimiento) {
                        if ($requerimiento->name == $productName) {
                            $path = "requerimientos/productos/{$productName}";
                            $filePath = $file->storeAs($path, $file->getClientOriginalName(), 'public');
                            $fileUrl = Storage::url($filePath);
                        }
                    }
                }
            }

            return $fileUrl;
        }, "Error guardando requerimientos.");
    }

    private static function actualizarStock($product, $quantityDifference = null)
    {
        self::executeWithErrorHandling(function () use ($product, $quantityDifference) {
            $productModel = Product::find($product['id']);
            $quantity = $quantityDifference ?? $product['quantity'];

            if ($productModel->type == "producto") {
                $productModel->stock -= $quantity;
                $productModel->save();
            } else if ($productModel->type == "paquete") {
                foreach ($product["products_in_package"] as $productInPackage) {
                    $productPack = Product::find($productInPackage["id"]);
                    $productPack->stock -= $quantity;
                    $productPack->save();
                }
            }
        }, "Error actualizando stock.");
    }

    private static function devolverStock($product)
    {
        self::executeWithErrorHandling(function () use ($product) {
            $productModel = Product::find($product['id']);

            if ($productModel->type == "producto") {
                $productModel->stock += $product->pivot->quantity;
                $productModel->save();
            } else if ($productModel->type == "paquete") {
                foreach ($product->pivot->products_in_package as $productInPackage) {
                    $productPack = Product::find($productInPackage["id"]);
                    $productPack->stock += $productInPackage["quantity"];
                    $productPack->save();
                }
            }
        }, "Error devolviendo stock.");
    }

    private static function updateSaleProduct($saleId, $productId, $quantity, $fileUrl)
    {
        DB::table('sale_products')
            ->where('sale_id', $saleId)
            ->where('product_id', $productId)
            ->update([
                'quantity' => $quantity,
                'url' => $fileUrl
            ]);
    }

    private static function deleteSaleProduct($saleId, $productId)
    {
        DB::table('sale_products')
            ->where('sale_id', $saleId)
            ->where('product_id', $productId)
            ->delete();
    }

    // ================================================================
    // GESTIÓN DE PRODUCTOS EN COMPRA
    // ================================================================

    public static function gestion_producto_compra($request, $saleId)
    {
        // Iteramos sobre los productos en el request
        foreach ($request["products"] as $product) {

            // Buscamos si el producto existe
            $producto = Product::where('id', $product["id"])->first();
            $requerimientos = $producto->requirements;
            $quantity = $product["quantity"];

            $new_stock = $producto->stock + $quantity;
            $producto->stock = $new_stock;
            $producto->save();

            // Guardamos los archivos de los productos
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

            // Revisión y actualización/creación del registro en purchase_products
            $existingSaleProduct = DB::table('purchase_products')
                ->where('purchase_id', $saleId)
                ->where('product_id', $product["id"])
                ->first();

            if ($existingSaleProduct) {
                // Actualizar la cantidad existente
                DB::table('purchase_products')
                    ->where('purchase_id', $saleId)
                    ->where('product_id', $product["id"])
                    ->update([
                        'quantity' => $existingSaleProduct->quantity + $quantity,
                        'url' => $fileUrl
                    ]);
            } else {
                // Crear un nuevo registro
                DB::table('purchase_products')->insert([
                    'purchase_id' => $saleId,
                    'product_id' => $product["id"],
                    'quantity' => $quantity,
                    'url' => $fileUrl
                ]);
            }
        }
    }

    // ================================================================
    // GESTIÓN DE ADELANTOS
    // ================================================================

    public static function gestion_adelanto($request, $sale_id, $caja)
    {
        Log::info("La caja es {$caja->id}");
        Log::info("El status de la venta es {$request["status_sale"]}");

        if ($request["status_sale"] == "in_process" || $request["status"] == "in_process") {
            return;
        }

        if ($request["status_sale"] == "charged" || $request["status"] == "charged") {
            Log::info("El total en caja es {$caja->income}");
            Log::info("El total es {$request["total"]}");
            $caja->income = $caja->income + $request["total"];
            $caja->save();
            return;
        }

        if ($request["status_sale"] == "in_parts" || $request["status"] == "in_parts") {
            Log::info("El total en caja es {$caja->income}");
            Log::info("El adelanto es {$request["money_advance"]}");

            $guardar_adelanto = SaleAdvance::create([
                'sale_id' => $sale_id,
                'advance_amount' => $request["money_advance"],
                'change' => $request["change"],
            ]);

            Log::info($guardar_adelanto);

            $caja->income = $caja->income + $request["money_advance"];
            $caja->save();
            return;
        }

        // 1. necesitamos traer todos los adelantos y verificar que no sea mayor o igual a $request["total"]
        // $saleAdvances = SaleAdvance::where('sale_id', $sale_id)->get();

        // $totalAdvances = 0;
        // foreach ($saleAdvances as $saleAdvance) {
        //     $totalAdvances += $saleAdvance->advance_amount;
        // }

        // // si resulta que es mayor se cambioa el estado de la venta a "charged" pero si es igual se cambia a "in_parts"
        // if ($totalAdvances >= $request["total"]) {
        //     $request["status_sale"] = "charged";
        //     Log::info("La venta se ha cargado completamente");
        //     Log::info("El total de los adelantos es {$totalAdvances}");
        //     $caja->income = $caja->income + $request["total"];
        //     $caja->save();
        // }else{
        //     $request["status_sale"] = "in_parts";
        //     $caja->income = $caja->income + $request["money_advance"];
        //     $caja->save();
        // }

        // if($request["status_sale"] == "in_parts" && isset($request["money_advance"]) && $request["money_advance"] > 0){
        //     // hacemos un log para saber si se paso por aqui
        //     SaleAdvance::create([
        //         'sale_id' => $sale_id,
        //         'advance_amount' => $request["money_advance"],
        //         'change' => $request["change"],
        //     ]);
        // }
    }

    public static function gestion_descuento($request, $sale_id)
    {

        if (isset($request["discount_id"]) && ($request["discount_id"] > 0 || $request["discount_id"] != "ninguno")) {
            // Primero verificamos si el descuento existe
            $existingDiscount = DB::table('sale_discounts')
                ->where('sale_id', $sale_id)
                ->where('discount_id', $request["discount_id"])
                ->first();

            if ($existingDiscount) {
                // Si existe, lo actualizamos
                DB::table('sale_discounts')
                    ->where('sale_id', $sale_id)
                    ->where('discount_id', $request["discount_id"])
                    ->update([
                        'total' => $request["discount"],
                        'updated_at' => now(),
                    ]);
            } else {
                // Si no existe, lo insertamos
                DB::table('sale_discounts')->insert([
                    'sale_id' => $sale_id,
                    'discount_id' => $request["discount_id"],
                    'total' => $request["discount"],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
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

    // ================================================================
    // CALCULAR EL TOTAL DE LA VENTA
    // ================================================================

    public static function calcular_monto_venta($request)
    {
        return self::executeWithErrorHandling(function () use ($request) {
            $amount = 0;

            // Iteramos sobre los productos en el request
            foreach ($request["products"] as $product) {
                Log::info("El producto es {$product["id"]}");
                // Obtenemos solo el precio de venta del producto desde la base de datos
                $salePrice = Product::where('id', $product["id"])->value('sale_price');
                Log::info("El precio de venta es {$salePrice}");

                if ($salePrice !== null) {
                    // Calculamos el total para este producto
                    $totalProducto = $salePrice * $product["quantity"];

                    // Sumamos al monto total
                    $amount += $totalProducto;
                }
            }

            return $amount;
        }, "Error calculando el monto de la venta.");
    }

    public static function calcular_total_venta($request, $monto, $id_venta = null)
    {
        return self::executeWithErrorHandling(function () use ($request, $monto, $id_venta) {
            $adelantos = 0;
            if ($id_venta) {
                $adelantos = SaleAdvance::where('sale_id', $id_venta)->sum('advance_amount');
            }
            $total = $monto + $request["tax"] - $request["discount"] - $request["money_advance"] - $adelantos;

            Log::info('Total calculado.', [
                'monto' => $monto,
                'tax' => $request["tax"],
                'discount' => $request["discount"],
                'money_advance' => $request["money_advance"],
                'adelantos' => $adelantos,
                'total' => $total
            ]);

            return $total;
        }, "Error calculando el total de la venta.");
    }

    // ================================================================
    // MÉTODOS DE MANEJO DE ERRORES
    // ================================================================

    private static function executeTransaction(callable $callback, $errorMessage)
    {
        DB::beginTransaction();
        try {
            $callback();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($errorMessage . " " . $e->getMessage());
            throw new \Exception($errorMessage);
        }
    }

    private static function executeWithErrorHandling(callable $callback, $errorMessage)
    {
        try {
            return $callback();
        } catch (\Exception $e) {
            Log::error($errorMessage . " " . $e->getMessage());
            throw new \Exception($errorMessage);
        }
    }
}
