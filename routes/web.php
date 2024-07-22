<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome',[
        'title' => 'SDN1068212 Bandar Baru'
    ]);
});

Route::get('/verify', function () {
    return view('public.auth',[
        'title' => 'SDN1068212 Bandar Baru'
    ]);
});


Route::get('/verified', function () {
    return view('public.home',[
        'title' => 'SDN1068212 Bandar Baru'
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';