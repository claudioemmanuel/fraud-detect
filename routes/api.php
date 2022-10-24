<?php

use App\Http\Controllers\API\V1\ClientController;
use App\Http\Controllers\API\V1\SaleController;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'v1', 'namespace' => 'API\V1'], function () {
    Route::get('/validate-cpf/{cpf}', [ClientController::class, 'validateCpf'])->name('validate-cpf');
    Route::post('/store-client', [ClientController::class, 'store'])->name('store-client');
    Route::post('/init-sale', [SaleController::class, 'initSale'])->name('init-sale');
});
