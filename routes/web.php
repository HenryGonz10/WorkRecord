<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PartesController;
use App\Http\Controllers\ClientesController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Ruta para el dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Ruta para la lista de partes
    Route::get('/partes', [PartesController::class, 'index'])->name('partes.index');
    Route::get('/partes/add', [PartesController::class, 'create'])->name('partes.add');

    // Ruta para la lista de clientes
    Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/add', [ClientesController::class, 'create'])->name('clientes.add');
    Route::post('/clientes/add', [ClientesController::class, 'store'])->name('clientes.store');
});
