<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genre';

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'nama',
    ];

    // Relasi: Satu genre memiliki banyak film
    public function film()
    {
        return $this->hasMany(Film::class, 'genre_id');
    }
}
