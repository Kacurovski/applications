<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GiftCardController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CustomOrderController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomOrderGalleryController;

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
    return redirect('/admin-dashboard');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin-dashboard', function () {
    return view('admin-dashboard');
})->middleware('admin')->name('admin-dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('admin-dashboard')->group(function () {
    Route::resource('types', TypeController::class)
        ->except(['show']);
    Route::resource('materials', MaterialController::class)
        ->except(['show']);
    Route::resource('faqs', FaqController::class)
        ->except(['show']);
    Route::resource('products', ProductController::class)
        ->except(['show']);
    Route::resource('maintenances', MaintenanceController::class)
        ->except(['show']);
    Route::resource('custom-orders', CustomOrderController::class);
    Route::resource('questions', QuestionController::class);
    Route::resource('coupons', CouponController::class)
        ->except(['show']);
    Route::resource('gift-cards', GiftCardController::class)
        ->except(['show']);
})->middleware('admin');

Route::post('/admin/upload-images', [CustomOrderGalleryController::class, 'upload']);
Route::get('/admin/upload-image', [CustomOrderGalleryController::class, 'test']);

require __DIR__.'/auth.php';
