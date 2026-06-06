<?php

namespace App\Http\Controllers;

use App\Services\GenreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Genre;

class GenreController extends Controller
{
    protected $genreService;

    public function __construct(GenreService $genreService)
    {
        $this->genreService = $genreService;
    }

    public function index()
    {
        Gate::authorize('viewAny', Genre::class);
        $genres = $this->genreService->getAll();
        return response()->json([
            'pesan' => 'Berhasil mengambil data genre',
            'data' => $genres
        ], 200);
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Genre::class);
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255|unique:genre,nama',
        ]);

        $genre = $this->genreService->create($validatedData);

        return response()->json([
            'pesan' => 'Genre berhasil ditambahkan',
            'data' => $genre
        ], 201);
    }

    public function show($id)
    {
        $genre = $this->genreService->getById($id);

        if (!$genre) {
            return response()->json([
                'pesan' => 'Genre tidak ditemukan'
            ], 404);
        }

        Gate::authorize('view', $genre);

        return response()->json([
            'pesan' => 'Berhasil mengambil data genre',
            'data' => $genre
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $genreCheck = $this->genreService->getById($id);
        if (!$genreCheck) {
            return response()->json(['pesan' => 'Genre tidak ditemukan'], 404);
        }
        Gate::authorize('update', $genreCheck);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255|unique:genre,nama,' . $id,
        ]);

        $genre = $this->genreService->update($id, $validatedData);

        if (!$genre) {
            return response()->json([
                'pesan' => 'Genre tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'pesan' => 'Genre berhasil diperbarui',
            'data' => $genre
        ], 200);
    }

    public function destroy($id)
    {
        $genreCheck = $this->genreService->getById($id);
        if (!$genreCheck) {
            return response()->json(['pesan' => 'Genre tidak ditemukan'], 404);
        }
        Gate::authorize('delete', $genreCheck);

        $deleted = $this->genreService->delete($id);

        if (!$deleted) {
            return response()->json([
                'pesan' => 'Genre tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'pesan' => 'Genre berhasil dihapus'
        ], 200);
    }
}
