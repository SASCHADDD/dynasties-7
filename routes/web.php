<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\FilmController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::apiResource('genres', GenreController::class)->middleware('auth:sanctum');
Route::apiResource('films', FilmController::class)->middleware('auth:sanctum');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware('auth');
Route::post('/films/{id}/watch', [FilmController::class, 'watch'])->middleware('auth:sanctum');
Route::get('/register', function () { return view('auth.register'); })->name('register');
Route::get('/login', function () { return view('auth.login'); })->name('login');