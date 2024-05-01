<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('create', [UserController::class, 'create'])->name('user.create');
Route::post('create', [UserController::class, 'store'])->name('user.store');
Route::get('show', [UserController::class, 'show'])->name('user.show');
Route::post('clear/session', [UserController::class, 'clearSession'])->name('clear.session');