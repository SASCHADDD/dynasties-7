<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\FilmController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::apiResource('genres', GenreController::class)->middleware('auth:sanctum');
Route::apiResource('films', FilmController::class)->middleware('auth:sanctum');
Route::post('/films/{id}/watch', [FilmController::class, 'watch'])->middleware('auth:sanctum');