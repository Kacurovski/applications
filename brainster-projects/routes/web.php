<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProjectController;

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
    return redirect()->route('projects.index');
});

Route::get('/projects',                                            [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/create',                                     [ProjectController::class, 'create'])->name('projects.create');
Route::get('/projects/edit',                                       [ProjectController::class, 'editMode'])->name('projects.editMode');
Route::post('/projects',                                           [ProjectController::class, 'store'])->name('projects.store');
Route::patch('/projects/{project}',                                [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/{project}',                               [ProjectController::class, 'destroy'])->name('projects.destroy');

Route::get('/login',                                               [AdminController::class, 'index'])->name('auth.index');
Route::post('/login',                                              [AdminController::class, 'login'])->name('auth.login');
Route::get('/logout',                                              [AdminController::class, 'logout'])->name('auth.logout');

Route::post('/submit-contact',                                     [ContactController::class, 'submitForm'])->name('submit.contact');