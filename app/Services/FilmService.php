<?php

namespace App\Services;

use App\Models\Film;
use Illuminate\Support\Facades\Storage;

class FilmService
{
    public function getAll()
    {
        return Film::with('genre')->get();
    }

    public function create(array $data)
    {
        return Film::create($data);
    }

    public function getById($id)
    {
        return Film::with('genre')->find($id);
    }

    public function update($id, array $data)
    {
        $film = Film::find($id);
        if ($film) {
            $film->update($data);
            return $film;
        }
        return null;
    }

    public function delete($id)
    {
        $film = Film::find($id);
        if ($film) {
            return $film->delete();
        }
        return false;
    }
}
