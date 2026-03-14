<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
// Use existing controllers but we'll modify them or create API versions
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\FavoriteController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Questions (Authenticated)
    Route::post('/questions', [QuestionController::class, 'store']);
    Route::put('/questions/{question}', [QuestionController::class, 'update']);
    Route::delete('/questions/{question}', [QuestionController::class, 'destroy']);

    // Responses
    Route::post('/questions/{question}/responses', [ResponseController::class, 'store']);
    Route::put('/responses/{response}', [ResponseController::class, 'update']);
    Route::delete('/responses/{response}', [ResponseController::class, 'destroy']);
    Route::post('/responses/{response}/solution', [ResponseController::class, 'markAsSolution']);

    // Favorites
    Route::post('/questions/{question}/favorite', [FavoriteController::class, 'toggle']);
    Route::get('/favorites', [FavoriteController::class, 'index']);

    // User Activity
    Route::get('/user/questions', [QuestionController::class, 'userQuestions']);
    Route::get('/user/responses', [ResponseController::class, 'userResponses']);
});

// Public Routes
Route::get('/questions', [QuestionController::class, 'index']);
Route::get('/questions/{question}', [QuestionController::class, 'show']);
