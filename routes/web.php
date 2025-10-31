<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QizController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('qizlar', QizController::class)->except('create','edit','show','update','destroy');
Route::get('/create/qiz', [QizController::class, 'create'])->name('qizlar.create');
Route::get('/edit/{qiz}', [QizController::class, 'edit'])->name('qizlar.edit');
Route::put('/update/{qiz}', [QizController::class, 'update'])->name('qizlar.update');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
