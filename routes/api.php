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
Route::get('/user', [\App\Http\Controllers\UserController::class, 'getUser']);
Route::get('/users', [\App\Http\Controllers\UserController::class, 'getUsers']);
Route::put('/user', [\App\Http\Controllers\UserController::class, 'updateUser']);
Route::post('/user', [\App\Http\Controllers\UserController::class, 'createUser']);

// QUESTION
Route::post('/question', [\App\Http\Controllers\QuestionController::class, 'createQuestion']);
Route::put('/question/{id}', [\App\Http\Controllers\QuestionController::class, 'updateQuestion']);
Route::get('/questions', [\App\Http\Controllers\QuestionController::class, 'listQuestions']);

// GAME
Route::post('/game', [\App\Http\Controllers\GameController::class, 'createGame']);
Route::get('/game', [\App\Http\Controllers\GameController::class, 'getGame']);
Route::put('/game/play', [\App\Http\Controllers\GameController::class, 'playGame']);

