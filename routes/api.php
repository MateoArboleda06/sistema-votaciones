<?php

use App\Http\Controllers\API\QuestionController;
use App\Http\Controllers\API\ResultController;
use App\Http\Controllers\API\VoteController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', RegisterController::class);
Route::post('/login', LoginController::class);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', UserController::class);
    Route::post('/logout', LogoutController::class);

    Route::middleware(['role:administrador'])->group(function () {
        Route::post('/questions', [QuestionController::class, 'store']);
        Route::get('/results/{question}', [ResultController::class, 'show']);
    });

    Route::get('/questions', [QuestionController::class, 'index']);
    Route::get('/questions/{question}', [QuestionController::class, 'show']);
    Route::post('/votes', [VoteController::class, 'store']);
});
