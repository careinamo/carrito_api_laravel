<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('catalogue/', 'CatalogueController')->name('catalogue');

Route::post('shopping-carts/store', [CartController::class, 'store'])
    ->name('shopping-cart.products.store');

Route::delete('shopping-cart', [CartController::class, 'destroy'])
    ->name('shopping-cart.products.destroy');