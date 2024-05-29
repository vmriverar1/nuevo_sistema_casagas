<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use App\Models\Brand;
use App\Models\Branch;
use App\Models\Product;
use App\Models\Category;
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
    }
}
