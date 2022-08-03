<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Produk\Http\Controllers\ProdukController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('produk')->group(function() {
    Route::get('all', [ProdukController::class, 'index'])->name('produk.all');
    Route::get('{id}', [ProdukController::class, 'show'])->name('produk.show');
    Route::post('create', [ProdukController::class, 'create'])->name('produk.store');
    Route::put('update/{id}', [ProdukController::class, 'update']);
    Route::delete('delete/{id}', [ProdukController::class, 'destroy'])->name('produk.delete');

    Route::post('store', [ProdukController::class, 'updateOrCreate'])->name('produk.update-or-create');

});
