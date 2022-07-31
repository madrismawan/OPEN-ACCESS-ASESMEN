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
    Route::get('all', [ProdukController::class, 'index']);
    Route::get('{id}', [ProdukController::class, 'show']);
    Route::post('create', [ProdukController::class, 'update']);
    Route::put('update/{id}', [ProdukController::class, 'update']);
    Route::delete('delete/{id}', [ProdukController::class, 'destroy']);

    Route::post('store', [ProdukController::class, 'updateOrCreate']);

});
