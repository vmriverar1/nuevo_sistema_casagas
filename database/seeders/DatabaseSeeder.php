<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\Sale;
use App\Models\User;
use App\Models\Brand;
use App\Models\Branch;
use App\Models\Product;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Requirement;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();
        Branch::factory(10)->create();
        Role::factory()->count(5)->create();

        User::factory()->count(35)->create()->each(function ($user) use ($faker) {

            // ==============================================
            // PIVOTE ADMINSTRADOR DE EMPRESAS
            // ==============================================

            $branch = $faker->numberBetween(1, 10);
            $exists = DB::table('admin_branch')
                          ->where('user_id', $user->id)
                          ->where('branch_id', $branch)
                          ->exists();

            if (!$exists) {
                DB::table('admin_branch')->insert([
                    'user_id' => $user->id,
                    'branch_id' => $branch,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // ==============================================
            //PIVOTE PARA USUARIOS POR RAMA
            // ==============================================

            for ($i=0; $i < $faker->numberBetween(4, 7); $i++) {
                $branch = $faker->numberBetween(1, 10);
                $exists = DB::table('user_branch')
                              ->where('user_id', $user->id)
                              ->where('branch_id', $branch)
                              ->exists();

                if (!$exists) {
                    DB::table('user_branch')->insert([
                        'user_id' => $user->id,
                        'branch_id' => $branch,
                        'status' => $faker->randomElement(['activo', 'inactivo', 'suspendido']),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // PIVOTE ROLES DE USUARIOS
            $roles = $faker->numberBetween(1, 5);
            $exists = DB::table('role_user')
                          ->where('user_id', $user->id)
                          ->where('role_id', $roles)
                          ->exists();

            if (!$exists) {
                DB::table('role_user')->insert([
                    'user_id' => $user->id,
                    'role_id' => $roles,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });

        Category::factory()->count(50)->create();
        Brand::factory()->count(50)->create();
        Requirement::factory()->count(20)->create();

        Product::factory()->count(100)->create()->each(function ($product) use ($faker) {

            // PIVOTE PRODUCTOS Y CATEGORIAS
            $cant_categorias = $faker->numberBetween(1, 4);
            for ($i=0; $i < $cant_categorias; $i++) {
                $categorias = $faker->numberBetween(1, 40);
                $exists = DB::table('product_categories')
                            ->where('product_id', $product->id)
                            ->where('category_id', $categorias)
                            ->exists();

                if (!$exists) {
                    DB::table('product_categories')->insert([
                        'product_id' => $product->id,
                        'category_id' => $categorias,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        });

        // Agregar datos a la tabla packages para productos que sean paquetes
        $packages = Product::where('type', 'paquete')->get();
        $nonPackages = Product::where('type', '!=', 'paquete')->get();

        foreach ($packages as $package) {
            $numProducts = rand(1, 8);
            $selectedProducts = $nonPackages->random($numProducts);

            foreach ($selectedProducts as $selectedProduct) {
                DB::table('packages')->insert([
                    'package_id' => $package->id,
                    'product_id' => $selectedProduct->id,
                    'quantity' => $faker->numberBetween(1, 2),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // ==============================================
        // REQUERIMIENTOS Y PRODUCTOS
        // ==============================================

        for ($i=0; $i < 100; $i++) {
            DB::table('product_requirements')->insert([
                'product_id' => $i+1,
                'requirement_id' => $faker->numberBetween(1, 20),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ==============================================
        // CAJAS CHICAS
        // ==============================================

        for ($i=0; $i < 35; $i++) {
            DB::table('petty_cashes')->insert([
                'responsible_id' => $i+1,
                'income' => 1000,
                'expense' => 200,
                'initial' => 100,
                'status' => 'abierta',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ==============================================
        // DOCUMENTOS CONTABLES
        // ==============================================

        for ($i=0; $i < 10; $i++) {

            DB::table('accounting_documents')->insert([
                'name' => 'boleta',
                'electronic_billing' => false,
                'tax_type' => 'in_price',
                'sale_percentage' => 0,
                'print_document' => '',
                'prefix_numbering' => 'AA1',
                'start_numbering' => '1',
                'branch_id' => $i+1,
                'mail_shipping' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('accounting_documents')->insert([
                'name' => 'factura',
                'electronic_billing' => false,
                'tax_type' => 'out_price',
                'sale_percentage' => 18,
                'print_document' => '',
                'prefix_numbering' => 'BB1',
                'start_numbering' => '1',
                'branch_id' => $i+1,
                'mail_shipping' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ==============================================
        // MÉTODOS DE PAGO
        // ==============================================

        for ($i=0; $i < 10; $i++) {
            DB::table('payment_methods')->insert([
                'name' => 'tarjeta',
                'commission' => 5,
                'type' => 'porcentaje',
                'branch_id' => $i+1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        for ($i=0; $i < 10; $i++) {
            DB::table('payment_methods')->insert([
                'name' => 'yape',
                'commission' => 0,
                'type' => 'fijo',
                'branch_id' => $i+1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ==============================================
        // PAGOS Y REQUERIMIENTOS
        // ==============================================

        for ($i=0; $i < 20; $i++) {
            DB::table('payment_requirement')->insert([
                'payment_methods_id' => $i+1,
                'requirement_id' => $faker->numberBetween(1, 20),
            ]);
        }

        // ==============================================
        // DESCUENTOS
        // ==============================================

        for ($i=0; $i < 10; $i++) {
            DB::table('discounts')->insert([
                'name' => 'Dcto normal',
                'status' => 'Activado',
                'type' => 'porcentaje',
                'markdown' => 10,
                'branch_id' => $i+1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        for ($i=0; $i < 10; $i++) {
            DB::table('discounts')->insert([
                'name' => 'Dcto fijo',
                'status' => 'Activado',
                'type' => 'fijo',
                'markdown' => 10,
                'branch_id' => $i+1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ==============================================
        // VENTAS
        // ==============================================

        Sale::factory()->count(250)->create();

        // ==============================================
        // VENTAS Y PRODUCTOS
        // ==============================================

        for ($i=0; $i < 250; $i++) {
            for ($a=0; $a < $faker->numberBetween(1, 5); $a++) {

                $product_id = $faker->numberBetween(1, 100);

                $exists = DB::table('sale_products')
                              ->where('sale_id', $i+1)
                              ->where('product_id', $product_id)
                              ->exists();
                if (!$exists) {
                    DB::table('sale_products')->insert([
                        'sale_id' => $i+1,
                        'product_id' => $product_id,
                        'quantity' => $faker->numberBetween(1, 10),
                    ]);
                }
            }
        }

        // ==============================================
        // VENTAS Y DESCUENTOS
        // ==============================================

        for ($i=0; $i < 250; $i++) {
            DB::table('sale_discounts')->insert([
                'sale_id' => $i+1,
                'discount_id' => $faker->numberBetween(1, 20),
                'total' => $faker->numberBetween(200, 300),
            ]);
        }

        // ==============================================
        // VENTAS Y MÉTODOS DE PAGO
        // ==============================================

        for ($i=0; $i < 250; $i++) {
            DB::table('sale_payment_methods')->insert([
                'sale_id' => $i+1,
                'payment_method_id' => $faker->numberBetween(1, 20),
                'total' => $faker->numberBetween(200, 300),
            ]);
        }

        // ==============================================
        // COMPRAS
        // ==============================================

        Purchase::factory()->count(250)->create();

        // ==============================================
        // COMPRAS Y PRODUCTOS
        // ==============================================

        for ($i=0; $i < 250; $i++) {
            for ($a=0; $a < $faker->numberBetween(1, 5); $a++) {

                $product_id = $faker->numberBetween(1, 100);

                $exists = DB::table('purchase_products')
                              ->where('purchase_id', $i+1)
                              ->where('product_id', $product_id)
                              ->exists();
                if (!$exists) {
                    DB::table('purchase_products')->insert([
                        'purchase_id' => $i+1,
                        'product_id' => $product_id,
                        'quantity' => $faker->numberBetween(1, 10),
                    ]);
                }
            }
        }

        // ==============================================
        // COMPRAS Y MÉTODOS DE PAGO
        // ==============================================

        for ($i=0; $i < 250; $i++) {
            DB::table('purchase_payment_methods')->insert([
                'purchase_id' => $i+1,
                'payment_method_id' => $faker->numberBetween(1, 20),
                'total' => $faker->numberBetween(200, 300),
            ]);
        }

    }
}
