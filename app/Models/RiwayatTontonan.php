<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatTontonan extends Model
{
    protected $table = 'riwayat_tontonan';

    // Tabel ini hanya punya 'ditonton_pada' sesuai ERD, tidak ada 'dibuat_pada'/'diperbarui_pada' standar
    public $timestamps = false;

    protected $fillable = [
        'pengguna_id',
        'film_id',
        'progres',
        'ditonton_pada'
    ];

    // Relasi: Riwayat tontonan milik satu pengguna
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    // Relasi: Riwayat tontonan merujuk pada satu film
    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id');
    }
}
