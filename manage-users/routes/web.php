<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ValidationController;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('admin/dashboard', [UserController::class, 'adminDashboard'])->name('admin.dashboard')->middleware('adminCheck');
    Route::get('user/panel', [UserController::class, 'userPanel'])->name('user.panel')->middleware('regularCheck');
});

require __DIR__.'/auth.php';


Route::get('/validation/{email}/{code}', [ValidationController::class, 'validateLink'])->name('validation.link');

Route::get('/expired-link/{user}/{code}', [ValidationController::class, 'showExpiredLink'])->name('expired.link');

Route::post('/regenerate-new-link/{user}', [ValidationController::class, 'regenerateNewLink'])->name('regenerate.new.link');


