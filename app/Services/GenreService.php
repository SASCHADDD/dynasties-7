<?php

namespace App\Services;

use App\Models\Genre;

class GenreService
{
    public function getAll()
    {
        return Genre::all();
    }

    public function create(array $data)
    {
        return Genre::create($data);
    }

    public function getById($id)
    {
        return Genre::find($id);
    }

    public function update($id, array $data)
    {
        $genre = Genre::find($id);
        if ($genre) {
            $genre->update($data);
            return $genre;
        }
        return null;
    }

    public function delete($id)
    {
        $genre = Genre::find($id);
        if ($genre) {
            return $genre->delete();
        }
        return false;
    }
}
