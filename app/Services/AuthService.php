<?php
namespace App\Services;

use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthService
{
     //Logika untuk mendaftarkan pengguna baru
  
    public function registerUser(array $data)
    {
        // Eloquent ORM untuk menyimpan data
        return Pengguna::create([
            'nama_pengguna' => $data['nama_pengguna'],
            'kata_sandi'    => Hash::make($data['kata_sandi']),
            'peran'         => 'pengguna', // Default peran
        ]);
    }

    
     //Logika untuk proses login
    public function login(array $credentials)
    {
        // Mencari pengguna berdasarkan nama_pengguna menggunakan ORM
        $pengguna = Pengguna::where('nama_pengguna', $credentials['nama_pengguna'])->first();

        // Memeriksa apakah pengguna ada dan kata sandi cocok
        if ($pengguna && Hash::check($credentials['kata_sandi'], $pengguna->kata_sandi)) {
            // Mendaftarkan session login
            Auth::login($pengguna);
            return $pengguna;
        }

        return false; // Login gagal
    }

   
     //Logika untuk logout
     
    public function logout()
    {
        Auth::logout();
    }
}