<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// ========================================================
// CAJA
// ========================================================

Route::get('/caja', function () {
    return view('caja');
})->name('caja');

// ========================================================
// PRODUCTOS
// ========================================================

Route::get('/productos', function () {
    return view('productos');
})->name('productos');

Route::get('/almacen', function () {
    return view('almacen');
})->name('almacen');

Route::get('/codigos', function () {
    return view('codigos');
})->name('codigos');

Route::get('/tiendas', function () {
    return view('tiendas');
})->name('tiendas');

// ========================================================
// USUARIOS
// ========================================================

Route::get('/usuarios', function () {
    return view('usuarios');
})->name('usuarios');

Route::get('/clientes', function () {
    return view('clientes');
})->name('clientes');

Route::get('/proveedores', function () {
    return view('proveedores');
})->name('proveedores');

// ========================================================
// CONFIGURACIONES
// ========================================================

Route::get('/reoprtes', function () {
    return view('reoprtes');
})->name('reoprtes');

// ========================================================
// CONFIGURACIONES
// ========================================================

Route::get('/configuraciones', function () {
    return view('configuraciones');
})->name('configuraciones');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
