<?php

namespace App\Policies;

use App\Models\Genre;
use App\Models\Pengguna;

class GenrePolicy
{
    public function viewAny(Pengguna $user): bool
    {
        return true;
    }

    public function view(Pengguna $user, Genre $genre): bool
    {
        return true;
    }

    public function create(Pengguna $user): bool
    {
        return $user->peran === 'admin';
    }

    public function update(Pengguna $user, Genre $genre): bool
    {
        return $user->peran === 'admin';
    }

    public function delete(Pengguna $user, Genre $genre): bool
    {
        return $user->peran === 'admin';
    }
}
