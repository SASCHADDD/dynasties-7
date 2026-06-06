<?php

namespace App\Http\Controllers;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    // Inject AuthService ke dalam Controller
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        // 1. Validasi Input
        $validatedData = $request->validate([
            'nama_pengguna' => 'required|string|max:100|unique:pengguna,nama_pengguna',
            'kata_sandi'    => 'required|string|min:6',
        ]);

        // 2. Eksekusi logika bisnis di Service
        $pengguna = $this->authService->registerUser($validatedData);

        // 3. Kembalikan Response
        return response()->json([
            'pesan' => 'Registrasi berhasil',
            'data' => $pengguna
        ], 201);
    }

    public function login(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'nama_pengguna' => 'required|string',
            'kata_sandi'    => 'required|string',
        ]);

        // 2. Eksekusi proses login di Service
        $result = $this->authService->login($credentials);

        // 3. Tangani Response
        if (!$result) {
            return response()->json(['pesan' => 'Nama pengguna atau kata sandi salah'], 401);
        }

        return response()->json([
            'pesan'  => 'Login berhasil',
            'peran'  => $result['pengguna']->peran,
            'token'  => $result['token'],
        ], 200);
    }

    public function logout(Request $request)
    {
        $pengguna = Auth::user();
        $this->authService->logout($pengguna);

        return response()->json(['pesan' => 'Logout berhasil'], 200);
    }
}
