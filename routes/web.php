<?php

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CashController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PettyCashController;
use App\Http\Controllers\UserPlateController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\AccountingDocumentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'check.cun'])->group(function () {

    Route::apiResource('accounting-documents', AccountingDocumentController::class);
    Route::apiResource('branches', BranchController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('brands', BrandController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('expenses', ExpenseController::class);
    Route::apiResource('payment-methods', PaymentMethodController::class);
    Route::apiResource('petty-cashes', PettyCashController::class);
    Route::apiResource('purchases', PurchaseController::class);
    Route::apiResource('requirements', RequirementController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('sales', SaleController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('suppliers', SupplierController::class);
    Route::apiResource('clients', ClientController::class);
    Route::apiResource('user-plates', UserPlateController::class);

    // ========================================================
    // HOME
    // ========================================================

    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // ========================================================
    // TIENDA
    // ========================================================

    Route::get('/tiendas', [BranchController::class, 'page'])->name('tiendas');

    // ========================================================
    // USUARIOS
    // ========================================================

    Route::get('/usuarios', [UserController::class, 'page_user'])->name('usuarios');
    Route::post('/check-email', [UserController::class, 'checkEmail'])->name('check-email');
    Route::post('/change-product-status', [UserController::class, 'changeStatus'])->name('change-product-status');

    Route::get('/clientes', [ClientController::class, 'page_client'])->name('clientes');
    Route::get('/proveedores', [SupplierController::class, 'page_supplier'])->name('proveedores');

    // ========================================================
    // PRODUCTOS
    // ========================================================

    Route::get('/productos', [ProductController::class, 'page'])->name('productos');
    Route::post('/change-product-status', [ProductController::class, 'changeStatus'])->name('change-product-status');
    Route::post('/move', [ProductController::class, 'moveProducts'])->name('move');

    // ========================================================
    // REQUERIMIENTOS
    // ========================================================

    Route::get('/requerimientos', function () {
        return view('requerimientos');
    })->name('requerimientos');

    // ========================================================
    // CAJA
    // ========================================================
    Route::get('/caja', [CashController::class, 'page'])->name('caja');
    Route::post('/hacer_venta ', [CashController::class, 'hacerVenta']);
    // -----VENTAS
    Route::get('/traer-venta/{venta_id}', [CashController::class, 'traerVenta']);
    // -----PRODUCTOS
    Route::get('/buscar-productos', [CashController::class, 'buscarProductos']);
    Route::get('/buscar-servicios', [CashController::class, 'buscarServicios']);
    Route::get('/buscar-paquetes', [CashController::class, 'buscarPaquetes']);
    Route::get('/producto/{id}', [CashController::class, 'obtenerProducto']);
    // -----COMPRAS
    Route::get('/buscar-compra/{document}', [CashController::class, 'buscarCompra']);
    Route::get('/traer-compra/{compra_id}', [CashController::class, 'traerCompra']);
    // -----CLIENTE
    Route::get('/buscar-cliente/{document}', [CashController::class, 'buscarCliente']);
    Route::get('/cliente-data/{documento}', [CashController::class, 'buscarClienteDetalle']);

});

Route::middleware(['auth'])->group(function () {

    // ========================================================
    // ELEGIR TIENDA
    // ========================================================

    Route::get('/elegir-tienda', [BranchController::class, 'choose_branch'])->name('elegir-tienda');
    Route::get('/choose_business/{cun}', [BranchController::class, 'choose_business'])->name('choose_business');


});


// ========================================================
// LOGIN
// ========================================================

// Auth::login($user);






// ========================================================
// CODIGO
// ========================================================

Route::get('/codigos', function () {
    return view('codigos');
})->name('codigos');





// ========================================================
// REPORTES
// ========================================================

Route::get('/generales', function () {
    return view('generales');
})->name('generales');

Route::get('/ventas', function () {
    return view('ventas');
})->name('ventas');

Route::get('/compras', function () {
    return view('compras');
})->name('compras');

Route::get('/caja-chica', function () {
    return view('caja-chica');
})->name('caja-chica');

Route::get('/incidencias', function () {
    return view('incidencias');
})->name('incidencias');

// ========================================================
// CONFIGURACIONES
// ========================================================

Route::get('/configuraciones', function () {
    return view('configuraciones');
})->name('configuraciones');


Auth::routes();


