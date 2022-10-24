<?php

use App\Http\Controllers\Front\ClientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ClientController::class, 'clientRegister'])->name('clients.register');
Route::get('/sales', [ClientController::class, 'clientSales'])->name('clients.sales');
