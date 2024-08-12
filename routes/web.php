<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome',[
        'title' => 'SDN1068212 Bandar Baru'
    ]);
})->name('home');

Route::prefix('/e/{evaluation:slug}')->group(function (){
    Route::get('/', [EvaluationController::class, 'evaluateVerify'])->name('evaluate.index');
    Route::get('{response:token}', [EvaluationController::class, 'evaluateStart'])->name('evaluate.start');
    Route::post('/', [EvaluationController::class, 'evaluateAuth'])->name('evaluate.verify');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';