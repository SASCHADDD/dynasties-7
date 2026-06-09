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

        // Auto log in user into session
        Auth::login($pengguna);

        // 3. Kembalikan Response
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'pesan' => 'Registrasi berhasil',
                'data' => $pengguna
            ], 201);
        }

        return redirect('/dashboard');
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
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['pesan' => 'Nama pengguna atau kata sandi salah'], 401);
            }
            return back()->with('error', 'Nama pengguna atau kata sandi salah.')->withInput();
        }

        // Log the user in to the web session
        Auth::login($result['pengguna'], $request->boolean('remember'));

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'pesan'  => 'Login berhasil',
                'peran'  => $result['pengguna']->peran,
                'token'  => $result['token'],
            ], 200);
        }

        return redirect('/dashboard');
    }

    public function logout(Request $request)
    {
        $pengguna = Auth::user();
        if ($pengguna) {
            $this->authService->logout($pengguna);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['pesan' => 'Logout berhasil'], 200);
        }

        return redirect('/login');
    }
}
