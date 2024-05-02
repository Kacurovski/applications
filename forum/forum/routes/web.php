<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return redirect()->route('discussion.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile',                                                  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',                                                [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',                                               [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('discussions/approve',                                       [DiscussionController::class, 'approve'])->name('discussion.approve')->middleware('admin');
    Route::get('/discussions/{discussion}/edit',                            [DiscussionController::class, 'edit'])->name('discussion.edit')->middleware('discussionAccess');

    Route::get('/discussions/{discussion}/comments/create',                 [CommentController::class, 'create'])->name('comment.create');
    Route::get('/discussions/{discussion}/comments/{comment}/edit',         [CommentController::class, 'edit'])->name('comment.edit')->middleware(['commentAccess', 'discussionAccess']);
});

require __DIR__.'/auth.php';

Route::middleware(['checkLogin'])->group(function () {
    Route::get('discussions/create', [DiscussionController::class, 'create'])
        ->name('discussion.create');
    
});


Route::get('/',                                                             [DiscussionController::class, 'index'])->name('discussion.index');

Route::get('/discussions/{discussion}',                                     [DiscussionController::class, 'show'])->name('discussion.show');
Route::patch('/discussions/{discussion}',                                   [DiscussionController::class, 'update'])->name('discussion.update');
Route::patch('/discussions/{discussion}/approve',                           [DiscussionController::class, 'approveDiscussion'])->name('discussion.approve.discussion')->middleware('admin');
Route::post('/discussions',                                                 [DiscussionController::class, 'store'])->name('discussion.store');
Route::delete('/discussions/{discussion}',                                  [DiscussionController::class, 'destroy'])->name('discussion.destroy');

Route::post('/discussions/{discussion}/comments',                           [CommentController::class, 'store'])->name('comment.store');
Route::patch('/discussions/{discussion}/comments/{comment}',                [CommentController::class, 'update'])->name('comment.update');
Route::delete('/discussions/{discussion}/comments/{comment}',               [CommentController::class, 'destroy'])->name('comment.destroy');



