<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'Dynasties') }} - @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
    <style>
        body {font-family: 'Inter', sans-serif;}
    </style>
</head>
<body class="dashboard-body">
    <header class="nara-header">
        <div class="nara-header-left">
            <span class="nara-logo">DYNASTIES-7</span>
            <nav class="nara-nav">
                <a href="/dashboard" class="nara-nav-item active">Home</a>
                <a href="#tv-section" class="nara-nav-item">Acara Tv</a>
                <a href="#all-media-section" class="nara-nav-item">Film</a>
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
    <footer class="p-4 text-center text-gray-400">
        &copy; {{ date('Y') }} {{ config('app.name', 'Dynasties') }}. All rights reserved.
    </footer>

    <script>
        const toggle = document.getElementById('theme-toggle');
        const root = document.documentElement;
        const currentTheme = localStorage.getItem('theme') || 'dark';
        if (currentTheme === 'light') root.classList.add('light');
        toggle.addEventListener('click', () => {
            if (root.classList.contains('light')) {
                root.classList.remove('light');
                localStorage.setItem('theme', 'dark');
            } else {
                root.classList.add('light');
                localStorage.setItem('theme', 'light');
            }
        });
    </script>
</body>
</html>
