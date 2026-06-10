<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\DashboardController;
use App\Models\RiwayatTontonan; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// 1. Halaman Publik (Bisa diakses tanpa login)
Route::get('/', function () { return view('welcome'); });
Route::get('/register', function () { return view('auth.register'); })->name('register');
Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// 2. Halaman User (Bisa diakses oleh siapapun yang sudah login, termasuk Admin1)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/tonton/{id}', [FilmController::class, 'tonton']);
    Route::post('/films/{id}/watch', [FilmController::class, 'watch']);
    
    // REVISI: Langsung panggil view 'riwayat' dan tarik datanya dari database tanpa perlu controller baru
    Route::get('/riwayat', function () {
        $riwayat = RiwayatTontonan::with('film')
                    ->where('pengguna_id', Auth::id())
                    ->orderBy('ditonton_pada', 'desc')
                    ->get();
        return view('riwayat', compact('riwayat'));
    })->name('riwayat.index');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// 3. Halaman Admin (Hanya untuk Admin)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [FilmController::class, 'indexWeb']);
    Route::get('/films/create', [FilmController::class, 'create']); 
    Route::post('/films', [FilmController::class, 'store'])->name('films.store');
    Route::get('/films/{id}/edit', [FilmController::class, 'edit']);
    Route::put('/films/{id}', [FilmController::class, 'updateWeb'])->name('films.update');
    Route::delete('/films/{id}', [FilmController::class, 'destroyWeb'])->name('films.destroy');
}); 

// 4. API Routes (Opsional: Tetap dipisahkan agar tidak mengganggu Web)
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('genres', GenreController::class);
    Route::apiResource('films', FilmController::class);
});