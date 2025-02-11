<?php
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    Route::get('/posts', [PostController::class, 'index'])->name('post.index');

    Route::get('/posts/create', [PostController::class, 'create'])
        ->name('post.create')
        ->middleware('can:post.create');
    
    Route::post('/posts', [PostController::class, 'store'])
        ->name('post.store')
        ->middleware('can:post.create');
    
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])
        ->name('post.edit')
        ->middleware('can:post.edit');
    
    Route::patch('/posts/{post}', [PostController::class, 'update'])
        ->name('post.update')
        ->middleware('can:post.edit');
    
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])
        ->name('post.destroy')
        ->middleware('can:post.destroy');
});

require __DIR__.'/auth.php';
