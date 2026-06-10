<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. Menghapus data lama terlebih dahulu agar tidak terjadi duplikat / error saat testing ulang
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('genre')->truncate();
        DB::table('pengguna')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2. Otomatis Memasukkan Data 5 Genre Induk dengan ID Terkunci (1-5)
        DB::table('genre')->insert([
            ['id' => 1, 'nama' => 'Drama', 'dibuat_pada' => now(), 'diperbarui_pada' => now()],
            ['id' => 2, 'nama' => 'Horor', 'dibuat_pada' => now(), 'diperbarui_pada' => now()],
            ['id' => 3, 'nama' => 'Comedy', 'dibuat_pada' => now(), 'diperbarui_pada' => now()],
            ['id' => 4, 'nama' => 'Action', 'dibuat_pada' => now(), 'diperbarui_pada' => now()],
            ['id' => 5, 'nama' => 'Romance', 'dibuat_pada' => now(), 'diperbarui_pada' => now()],
        ]);

        // 3. Otomatis Memasukkan Akun Admin Utama agar langsung bisa login tanpa daftar
        DB::table('pengguna')->insert([
            'nama_pengguna' => 'admin',          // <-- Gunakan ini untuk login
            'kata_sandi'    => Hash::make('admin123'), // <-- Gunakan ini untuk password
            'peran'         => 'admin',
        ]);
    }
}