@extends('layouts.auth')

@section('title', 'Register')

@section('content')
@php
    $posters = [
        'https://images.unsplash.com/photo-1635805737707-575885ab0820?w=240&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1594909122845-11baa439b7bf?w=240&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1608889174633-41a2c28892e8?w=240&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?w=240&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1536440136628-849c177e76a1?w=240&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1509248961158-e54f6934749c?w=240&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1542751371-adc38448a05e?w=240&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=240&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?w=240&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1578632767115-351597cf2477?w=240&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1509198397868-475647b2a1e5?w=240&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1505635338263-f7f565b3f456?w=240&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=240&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1508739773434-c26b3d09e071?w=240&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1511447333015-45b65e60f6d5?w=240&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1519608487953-e999c86e7455?w=240&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?w=240&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=240&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1626814026160-2237a95fc5a0?w=240&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?w=240&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1578849278619-e73505e9610f?w=240&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1535016120720-40c646be5580?w=240&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1485846234645-a62644f84728?w=240&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1542204172-e7052809f852?w=240&auto=format&fit=crop'
    ];
@endphp

<div class="auth-container">
    <div class="auth-bg-grid">
        @foreach($posters as $poster)
            <div class="poster-card" style="background-image: url('{{ $poster }}');"></div>
        @endforeach
    </div>
    
    <div class="auth-bg-overlay"></div>

    <div class="auth-card">
        <h2 class="auth-title">Register</h2>
        <p class="auth-subtitle">Silahkan Masukan Username & Password</p>

        @if(session('error'))
            <div class="auth-alert-error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="/register">
            @csrf
            <div class="auth-input-wrapper">
                <input type="text" name="nama_pengguna" placeholder="Username" required class="auth-input" autocomplete="username" />
            </div>

            <div class="auth-input-wrapper">
                <input type="password" name="kata_sandi" placeholder="Password" required class="auth-input" autocomplete="new-password" />
            </div>

            <button type="submit" class="auth-btn">Sign up</button>

            <div class="auth-footer">
                Sudah punya akun? <a href="/login">Login di sini.</a>
            </div>
        </form>
    </div>
</div>
@endsection