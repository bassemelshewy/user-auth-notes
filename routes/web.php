<?php

use App\Http\Controllers\NotesController;
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



Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'notes'], function () {
        Route::get('/', [NotesController::class, 'index'])->name('notes.index');
        Route::get('/create', [NotesController::class, 'create'])->name('notes.create');
        Route::post('/', [NotesController::class, 'store'])->name('notes.store');
        Route::get('/{id}/edit', [NotesController::class, 'edit'])->name('notes.edit');
        Route::put('/{id}/update', [NotesController::class, 'update'])->name('notes.update');
        Route::delete('/{id}/delete', [NotesController::class, 'delete'])->name('notes.destroy');
        Route::post('/search', [NotesController::class, 'search'])->name('notes.search');
    });

});



require __DIR__.'/auth.php';
