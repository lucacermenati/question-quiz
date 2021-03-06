<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// AUTHENTICATION
Route::get('/token', [\App\Http\Controllers\CustomAuthenticationController::class, 'getToken']);

// USER
Route::post('/user', [\App\Http\Controllers\UserController::class, 'createUser']);

// QUESTION
Route::post('/question', [\App\Http\Controllers\QuestionController::class, 'createQuestion']);
Route::put('/question/{id}', [\App\Http\Controllers\QuestionController::class, 'updateQuestion']);
Route::get('/questions', [\App\Http\Controllers\QuestionController::class, 'listQuestions']);

// GAME
Route::post('/game', [\App\Http\Controllers\GameController::class, 'createGame']);
Route::get('/game', [\App\Http\Controllers\GameController::class, 'getGame']);
Route::get('/game/stats', [\App\Http\Controllers\GameController::class, 'getStats']);
Route::put('/game/play', [\App\Http\Controllers\GameController::class, 'playGame']);
Route::put('/game/reset', [\App\Http\Controllers\GameController::class, 'resetGame']);

