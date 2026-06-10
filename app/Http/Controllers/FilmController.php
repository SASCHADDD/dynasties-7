<?php

namespace App\Http\Controllers;

use App\Services\FilmService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Film;
use App\Models\RiwayatTontonan;
use Illuminate\Support\Facades\Auth; 

class FilmController extends Controller
{
    protected $filmService;

    public function __construct(FilmService $filmService)
    {
        $this->filmService = $filmService;
    }

    public function indexWeb()
    {
        // Mengambil semua film untuk ditampilkan di dashboard
        $films = $this->filmService->getAll(); 
        return view('dashboardadmin', compact('films'));
    }

    public function index()
    {
        Gate::authorize('viewAny', Film::class);
        $films = $this->filmService->getAll();
        return response()->json([
            'pesan' => 'Berhasil mengambil data film',
            'data' => $films
        ], 200);
    }

    public function create()
    {
        return view('films.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi sesuai dengan field di form create.blade.php
        $validatedData = $request->validate([
        'genre_id'    => 'required|exists:genre,id',
        'tipe'        => 'required|in:film,acara_tv',
        'judul'       => 'required|string|max:255',
        'deskripsi'   => 'nullable|string',
        'durasi'      => 'nullable|integer',
        'tahun_rilis' => 'nullable|integer',
        'poster'      => 'nullable|string',
        'url_video'   => 'nullable|string',
        ]);

        // 2. Kirim data ke Service
        $this->filmService->create($validatedData);

        // 3. Redirect ke halaman admin agar user melihat hasil penambahan
        return redirect('/admin')->with('success', 'Film berhasil ditambahkan!');
    }

    public function show($id)
    {
        $film = $this->filmService->getById($id);

        if (!$film) {
            return response()->json([
                'pesan' => 'Film tidak ditemukan'
            ], 404);
        }

        Gate::authorize('view', $film);

        return response()->json([
            'pesan' => 'Berhasil mengambil data film',
            'data' => $film
        ], 200);
    }

        // Menampilkan form edit
    public function edit($id)
    {
        $film = $this->filmService->getById($id);
        $genres = \App\Models\Genre::all();
        return view('films.edit', compact('film', 'genres'));
    }

    // Menangani update dari form
    public function updateWeb(Request $request, $id)
    {
        $validatedData = $request->validate([
            'genre_id'    => 'required|exists:genre,id',
            'tipe'        => 'required|in:film,acara_tv',
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'durasi'      => 'nullable|integer',
            'tahun_rilis' => 'nullable|integer',
            'poster'      => 'nullable|string',
            'url_video'   => 'nullable|string',
        ]);

        $this->filmService->update($id, $validatedData);
        return redirect('/admin')->with('success', 'Film berhasil diperbarui!');
    }

    // Menangani hapus dari form
    public function destroyWeb($id)
    {
        $this->filmService->delete($id);
        return redirect('/admin')->with('success', 'Film berhasil dihapus!');
    }

    public function tonton($id)
    {
        $film = $this->filmService->getById($id);
        
        if (!$film) {
            return redirect('/dashboard')->with('error', 'Film tidak ditemukan.');
        }
        
        return view('tonton', compact('film'));
    }

    public function watch(Request $request, $id)
    {
        // 1. Validasi data progres yang dikirim dari halaman tonton (0 sampai 100%)
        $request->validate([
            'progres' => 'required|integer|min:0|max:100',
        ]);

        // 2. Gunakan updateOrCreate: Jika riwayat film ini sudah ada, update progresnya. Jika belum, buat baru.
        $riwayat = RiwayatTontonan::updateOrCreate(
            [
                'pengguna_id' => Auth::id(),
                'film_id'     => $id,
            ],
            [
                'progres'       => $request->progres,
                'ditonton_pada' => now(), // Mencatat waktu tonton terbaru
            ]
        );

        return response()->json(['pesan' => 'Riwayat berhasil disimpan', 'data' => $riwayat], 200);
    }
}
