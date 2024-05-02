<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\api\TagController;
use App\Http\Controllers\api\BrandsController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\DiscountController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', [ProductController::class, 'index']);
Route::delete('/products/{product}', [ProductController::class, 'destroy']);
Route::delete('/discounts/{discount}', [DiscountController::class, 'destroy']);
Route::delete('/brands/{brand}', [BrandController::class, 'destroy']);

Route::get('/tags', [TagController::class, 'index'])->name('tags');
Route::get('/discounts', [DiscountController::class, 'index']);
Route::get('/brands', [BrandsController::class, 'index']);
