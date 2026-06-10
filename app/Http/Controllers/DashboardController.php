<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use App\Models\RiwayatTontonan; // Import Model Riwayat
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $filmCount = Film::count();
        $genreCount = Genre::count();
        
        // REVISI 1: Hanya mengambil konten yang bertipe 'film'
        $recentFilms = Film::where('tipe', 'film')
                            ->orderByDesc('dibuat_pada')
                            ->limit(10)
                            ->get();

        // REVISI 2: Hanya mengambil konten yang bertipe 'acara_tv'
        $recentTvShows = Film::where('tipe', 'acara_tv')
                            ->orderByDesc('dibuat_pada')
                            ->limit(10)
                            ->get();

        $riwayat = RiwayatTontonan::with('film')
                    ->where('pengguna_id', Auth::id())
                    ->orderBy('ditonton_pada', 'desc')
                    ->limit(10) 
                    ->get();

        // REVISI 3: Pastikan variabel $recentTvShows ikut dikirim (compact) ke halaman view
        return view('dashboard', compact('filmCount', 'genreCount', 'recentFilms', 'recentTvShows', 'riwayat'));
    }
}