<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\RegistrationStepController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\MultistepRegistrationController;
use App\Http\Controllers\Auth\AdminAuthenticatedSessionController;
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


Route::middleware('guest')->group(function () {
     // Google Auth Routes
     Route::get('/auth/google/redirect', [SocialiteController::class, 'redirectToGoogle'])->name('auth.google');
     Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

     // Facebook Auth Routes
     Route::get('/auth/facebook/redirect', [SocialiteController::class, 'redirectToFacebook'])->name('auth.facebook');
     Route::get('/auth/facebook/callback', [SocialiteController::class, 'handleFacebookCallback']);

     // Multistep Registration Routes
     Route::get('register/step1', [MultistepRegistrationController::class, 'createStep1'])->name('register.step1');
     Route::post('register/step1', [MultistepRegistrationController::class, 'storeStep1'])->name('register.store.step1');

     Route::get('register/step2', [MultistepRegistrationController::class, 'createStep2'])->name('register.step2');
     Route::post('register/step2', [MultistepRegistrationController::class, 'storeStep2'])->name('register.store.step2');

     Route::get('register/step3', [MultistepRegistrationController::class, 'createStep3'])->name('register.step3');
     Route::post('register/finalize', [RegisteredUserController::class, 'store'])->name('register.finalize');

     Route::get('login', [MultistepRegistrationController::class, 'create'])->name('login.user');
     Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
     ->middleware('auth')
     ->name('logout');



Route::get('/', [ProductController::class, 'index'])->middleware('isAdmin')->name('homepage');

Route::resource('brands', BrandController::class)->middleware('isAdmin');
Route::resource('products', ProductController::class)->middleware('isAdmin');
Route::resource('discounts', DiscountController::class)->middleware('isAdmin');

Route::prefix('admin')->name('admin.')->group(function () {
     Route::get('login', [AdminAuthenticatedSessionController::class, 'create'])->name('login');
     Route::post('login', [AdminAuthenticatedSessionController::class, 'store'])->name('login');
     Route::post('logout', [AdminAuthenticatedSessionController::class, 'destroy'])->name('logout');
     Route::get('profile', [AdminAuthenticatedSessionController::class, 'showProfile'])->middleware('isAdmin')->name('profile');
     Route::put('update/profile', [AdminAuthenticatedSessionController::class, 'updateProfile'])->middleware('isAdmin')->name('profile.update');
     Route::get('/password/change', [AdminAuthenticatedSessionController::class, 'showChangePasswordForm'])->middleware('isAdmin')->name('password.change');
     Route::put('/password/update', [AdminAuthenticatedSessionController::class, 'changePassword'])->middleware('isAdmin')->name('password.update');
});

Route::get('profile', [RegisteredUserController::class, 'profile'])->name('profile')->middleware(['isRegularUser', 'auth']);
