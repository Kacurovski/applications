<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ValidationController;

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

Route::get('/users', [AdminController::class, 'index']);

Route::post('/user', [AdminController::class, 'store']);
Route::delete('/user/{user}', [AdminController::class, 'destroy']);

Route::put('/user/{user}/deactivate', [AdminController::class, 'deactivate']);

Route::post('/regenerate-new-link/{user}', [ValidationController::class, 'regenerateNewLink'])->name('regenerate.new.link');







