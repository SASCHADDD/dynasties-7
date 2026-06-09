<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the user dashboard.
     *
     * This method gathers a few summary statistics that are displayed on the
     * dashboard view. Adjust the queries as needed to match the exact data you
     * want to present.
     */
    public function index()
    {
        // Basic summary data – you can extend this with more sophisticated
        // metrics (e.g., recent watches, user profile, etc.).
        $filmCount = Film::count();
        $genreCount = Genre::count();
        $recentFilms = Film::orderByDesc('dibuat_pada')->limit(5)->get();

        return view('dashboard', compact('filmCount', 'genreCount', 'recentFilms'));
    }
}
