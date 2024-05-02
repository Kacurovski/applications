<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FaqApiController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\CustomOrderController;
use App\Http\Controllers\Api\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('categories', [CategoryController::class, 'index']);

// Route::get('categories/create', [CategoryController::class, 'create']);

// Route::post('categories', [CategoryController::class, 'store']);

// Route::put('categories/{category}', [CategoryController::class, 'update']);

// Route::delete('categories/{category}', [CategoryController::class, 'destroy']);

Route::get('/jewelry', [TypeController::class, 'getJewelryTypes']);

Route::get('/home_decor', [TypeController::class, 'getHomeDecorTypes']);

Route::get('/products', [ProductController::class, 'types']);

Route::get('/custom_order_gallery', [CustomOrderController::class, 'getLatestImages']);

Route::get('/faqs', [FaqApiController::class, 'index']);

Route::get('/cart-items', [UserController::class, 'getUserCartItems']);

Route::get('/favorite-items', [UserController::class, 'getUserFavoriteItems']);

Route::post('/custom-order', [CustomOrderController::class, 'submitCustomOrder']);

Route::post('/questions', [QuestionController::class, 'store']);

Route::get('/products/types', [DashboardController::class, 'getProductTypes']);

Route::get('/products/materials', [DashboardController::class, 'getMaterialChartData']);

Route::get('/products/favorites', [DashboardController::class, 'getFavoriteProductsChartData']);

Route::get('/products/most-ordered', [DashboardController::class, 'getMostOrderedProductsChartData']);

Route::get('/products/most-revenue', [DashboardController::class, 'getMostRevenueProductsChartData']);

Route::delete('/imageDelete/{id}', [ProductController::class, 'imageDelete']);
