<?php

namespace App\Http\Controllers;

use App\Services\FilmService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Film;
use App\Models\RiwayatTontonan;

class FilmController extends Controller
{
    protected $filmService;

    public function __construct(FilmService $filmService)
    {
        $this->filmService = $filmService;
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

    public function store(Request $request)
    {
        Gate::authorize('create', Film::class);
        $validatedData = $request->validate([
            'genre_id'    => 'required|exists:genre,id',
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'durasi'      => 'nullable|integer',
            'tahun_rilis' => 'nullable|integer',
            'poster'      => 'nullable|string',
            'url_video'   => 'nullable|string',
        ]);

        $film = $this->filmService->create($validatedData);

        return response()->json([
            'pesan' => 'Film berhasil ditambahkan',
            'data' => $film
        ], 201);
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

    public function update(Request $request, $id)
    {
        $filmCheck = $this->filmService->getById($id);
        if (!$filmCheck) {
            return response()->json(['pesan' => 'Film tidak ditemukan'], 404);
        }
        Gate::authorize('update', $filmCheck);

        $validatedData = $request->validate([
            'genre_id'    => 'sometimes|required|exists:genre,id',
            'judul'       => 'sometimes|required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'durasi'      => 'nullable|integer',
            'tahun_rilis' => 'nullable|integer',
            'poster'      => 'nullable|string',
            'url_video'   => 'nullable|string',
        ]);

        $film = $this->filmService->update($id, $validatedData);

        if (!$film) {
            return response()->json([
                'pesan' => 'Film tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'pesan' => 'Film berhasil diperbarui',
            'data' => $film
        ], 200);
    }

    public function destroy($id)
    {
        $filmCheck = $this->filmService->getById($id);
        if (!$filmCheck) {
            return response()->json(['pesan' => 'Film tidak ditemukan'], 404);
        }
        Gate::authorize('delete', $filmCheck);

        $deleted = $this->filmService->delete($id);

        if (!$deleted) {
            return response()->json([
                'pesan' => 'Film tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'pesan' => 'Film berhasil dihapus'
        ], 200);
    }

    public function watch(Request $request, $id)
    {
        $film = $this->filmService->getById($id);

        if (!$film) {
            return response()->json([
                'pesan' => 'Film tidak ditemukan'
            ], 404);
        }

        $validatedData = $request->validate([
            'progres' => 'required|integer|min:0|max:100',
        ]);

        $pengguna = $request->user();

        // Cari riwayat sebelumnya atau buat baru
        $riwayat = RiwayatTontonan::updateOrCreate(
            ['pengguna_id' => $pengguna->id, 'film_id' => $id],
            ['progres' => $validatedData['progres'], 'ditonton_pada' => now()]
        );

        return response()->json([
            'pesan' => 'Riwayat tontonan berhasil disimpan',
            'data' => $riwayat
        ], 200);
    }
}
