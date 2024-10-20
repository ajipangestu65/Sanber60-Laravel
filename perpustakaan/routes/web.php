<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Landing');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])
    ->prefix('kelola')
    ->group(function () {
        Route::controller(BookController::class)
            ->group(function () {
                Route::get('/books', [BookController::class, 'index'])
                    ->name('book.index');
            });

        Route::controller(CategoryController::class)
            ->group(function () {
                Route::get('/category', [CategoryController::class, 'index'])
                    ->name('category.index');
                Route::post('/category', [CategoryController::class, 'store'])
                    ->name('category.store');
                Route::put('/category/{category}', [CategoryController::class, 'update'])
                    ->name('category.update');
                Route::delete('/category/{category}', [CategoryController::class, 'destroy'])
                    ->name('category.destroy');
            });
    });

require __DIR__ . '/auth.php';
