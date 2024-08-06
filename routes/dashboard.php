<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    
    Route::resource('teachers', TeacherController::class);
    Route::prefix('teachers')->group(function () {
        Route::post('search', [TeacherController::class, "search"])->name('teachers.search');
    });

    Route::resource('rooms', RoomController::class);
    Route::prefix('rooms')->group(function () {
        Route::post('search', [RoomController::class, "search"])->name('rooms.search');
    });

    Route::resource('students', StudentController::class);
    Route::prefix('students')->group(function () {

    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [RegisteredUserController::class, 'create'])
                ->name('users.create');

        Route::post('create', [RegisteredUserController::class, 'store'])->name('users.store');
        Route::get('{user:username}', [UserController::class, 'show'])->name('users.show');
        Route::delete('{user:username}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    Route::resource('evaluations', EvaluationController::class);
});