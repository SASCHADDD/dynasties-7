<?php

namespace App\Policies;

use App\Models\Film;
use App\Models\Pengguna;

class FilmPolicy
{
    public function viewAny(Pengguna $user): bool
    {
        return true;
    }

    public function view(Pengguna $user, Film $film): bool
    {
        return true;
    }

    public function create(Pengguna $user): bool
    {
        return $user->peran === 'admin';
    }

    public function update(Pengguna $user, Film $film): bool
    {
        return $user->peran === 'admin';
    }

    public function delete(Pengguna $user, Film $film): bool
    {
        return $user->peran === 'admin';
    }
}
