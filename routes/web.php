<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\CarritoController;

Route::get('/', function () {
    return redirect()->route('tienda.index');
});

// Auth Routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Store Routes
Route::get('tienda', [TiendaController::class, 'index'])->name('tienda.index');

// Cart Routes (Protected)
Route::middleware('auth')->group(function () {
    Route::get('carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('carrito/add/{articulo}', [CarritoController::class, 'add'])->name('carrito.add');
    Route::delete('carrito/remove/{articulo}', [CarritoController::class, 'remove'])->name('carrito.remove');
});

Route::resource('articulos', ArticuloController::class);
