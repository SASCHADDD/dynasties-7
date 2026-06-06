<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pengguna extends Authenticatable
{
    use HasApiTokens, Notifiable;

    // Sesuaikan nama tabel
    protected $table = 'pengguna';

    // Sesuaikan nama kolom timestamp
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    // Kolom yang boleh diisi
    protected $fillable = [
        'nama_pengguna',
        'kata_sandi',
        'peran',
    ];

    // Sembunyikan kata sandi saat data diambil
    protected $hidden = [
        'kata_sandi',
    ];

    // Karena password di Laravel defaultnya mencari kolom 'password', kita harus beritahu 
    // Laravel untuk menggunakan 'kata_sandi' untuk autentikasi
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }

    // Relasi: Pengguna mempunyai banyak riwayat tontonan
    public function riwayatTontonan()
    {
        return $this->hasMany(RiwayatTontonan::class, 'pengguna_id');
    }
}
