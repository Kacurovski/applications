<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\MetchController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProfileController;

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
    return redirect()->route('metches.index');
});

// Route::get('metches.index', function () {
//     return view('metches.index');
// })->middleware(['auth', 'verified'])->name('metches.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('metches', MetchController::class)->only(['index']);
});

require __DIR__.'/auth.php';

Route::middleware(['admin'])->group(function () {
    Route::resource('teams', TeamController::class)->middleware('auth');
    Route::resource('players', PlayerController::class)->middleware('auth');
    Route::resource('metches', MetchController::class)->except(['index']);
});

// Route::get('/metches', [MetchController::class, 'index'])->name('metches.index');

