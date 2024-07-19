<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get("signin", [AuthController::class, "index"]);
Route::post("signin", [AuthController::class, "auth"]);