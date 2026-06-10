<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'Dynasties') }} - @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    
    <style>
        /* Variabel Warna Global Meniru Dashboard Admin */
        :root { 
            --primary: #e50914; 
            --bg: #121212; 
            --surface: #1e1e1e; 
            --border: #333; 
            --text: #e0e0e0; 
            --text-muted: #aaa;
        }

        body {
            background-color: var(--bg); 
            color: var(--text); 
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* 1. Desain Navbar Premium (Sama dengan Atmosfer Admin) */
        .nara-header {
            background-color: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nara-header-left {
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .nara-logo {
            color: #fff;
            font-size: 1.4rem;
            font-weight: 700;
            letter-spacing: 1px;
            border-left: 4px solid var(--primary);
            padding-left: 12px;
            line-height: 1;
        }

        .nara-nav {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .nara-nav-item {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            padding: 6px 12px;
            border-radius: 4px;
        }

        .nara-nav-item:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.05);
        }

        /* Menu Navbar yang Sedang Aktif */
        .nara-nav-item.active {
            color: #fff;
            background-color: rgba(229, 9, 20, 0.15);
            font-weight: 600;
            border: 1px solid rgba(229, 9, 20, 0.3);
        }

        /* Tombol Sign Out Kotak Premium */
        .nara-header-right {
            display: flex;
            align-items: center;
        }

        .nara-logout-btn {
            background: transparent;
            color: #ff6b6b;
            padding: 8px 20px;
            border-radius: 4px;
            font-size: 0.9rem;
            font-weight: 600;
            border: 1px solid #552a2a;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .nara-logout-btn:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            box-shadow: 0 0 12px rgba(229, 9, 20, 0.4);
        }

        /* 2. Container Utama Konten */
        .dashboard-main {
            flex: 1;
            width: 100%;
            box-sizing: border-box;
        }

        /* Footer */
        footer {
            padding: 25px;
            text-align: center;
            color: #666;
            font-size: 0.85rem;
            border-top: 1px solid var(--border);
            background: #161616;
            margin-top: auto;
        }
    </style>
</head>
<body class="dashboard-body">

    <header class="nara-header">
        <div class="nara-header-left">
            <span class="nara-logo">DYNASTIES-7</span>
            <nav class="nara-nav">
                <a href="/dashboard" class="nara-nav-item {{ Request::is('dashboard') ? 'active' : '' }}">Home</a>
                <a href="/dashboard#film-section" class="nara-nav-item">Film</a>
                <a href="/dashboard#tv-section" class="nara-nav-item">Acara Tv</a>
                <a href="/riwayat" class="nara-nav-item {{ Request::is('riwayat') ? 'active' : '' }}">Riwayat</a>
            </nav>
        </div>
        <div class="nara-header-right">
            <form method="POST" action="{{ route('logout') }}" class="nara-logout-form">
                @csrf
                <button type="submit" class="nara-logout-btn">Sign Out</button>
            </form>
        </div>
    </header>

    <main class="dashboard-main">
        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} {{ config('app.name', 'Dynasties') }}. All rights reserved.
    </footer>

</body>
</html>