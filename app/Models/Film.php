<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = 'film';

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'genre_id',
        'judul',
        'deskripsi',
        'durasi',
        'tahun_rilis',
        'poster',
        'url_video',
    ];

    // Relasi: Film dimiliki oleh satu genre
    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    // Relasi: Film memiliki banyak riwayat tontonan
    public function riwayatTontonan()
    {
        return $this->hasMany(RiwayatTontonan::class, 'film_id');
    }
}
