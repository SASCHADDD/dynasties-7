@extends('layouts.app')

@section('title', 'Home')

@section('content')
@php
    $defaultFilms = [
        [
            'judul' => 'Everything Everywhere All At Once',
            'poster' => 'https://images.unsplash.com/photo-1626814026160-2237a95fc5a0?w=300&auto=format&fit=crop',
            'rating' => 'WEBDL'
        ],
        [
            'judul' => 'The Grand Budapest Hotel',
            'poster' => 'https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?w=300&auto=format&fit=crop',
            'rating' => 'WEBDL'
        ],
        [
            'judul' => 'Spirited Away',
            'poster' => 'https://images.unsplash.com/photo-1578632767115-351597cf2477?w=300&auto=format&fit=crop',
            'rating' => 'WEBDL'
        ],
        [
            'judul' => 'The Matrix',
            'poster' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=300&auto=format&fit=crop',
            'rating' => 'WEBDL'
        ],
        [
            'judul' => 'Parasite',
            'poster' => 'https://images.unsplash.com/photo-1535016120720-40c646be5580?w=300&auto=format&fit=crop',
            'rating' => 'WEBDL'
        ],
        [
            'judul' => 'Inception',
            'poster' => 'https://images.unsplash.com/photo-1509198397868-475647b2a1e5?w=300&auto=format&fit=crop',
            'rating' => 'WEBDL'
        ]
    ];

    // Build collections to display
    $topFilms = $recentFilms->count() > 0 ? $recentFilms : collect($defaultFilms)->map(fn($f) => (object)$f);
    $topTvShows = collect($defaultFilms)->shuffle()->map(fn($f) => (object)$f);
    $allMedia = $recentFilms->count() > 0 ? $recentFilms : collect($defaultFilms)->map(fn($f) => (object)$f);
@endphp

<div class="nara-container">
    <!-- Section 1: Top 10 Films -->
    <section class="nara-section" id="film-section">
        <h2 class="nara-section-title">10 Film Teratas di Indonesia Hari Ini</h2>
        <div class="nara-slider">
            @foreach($topFilms as $index => $item)
                <div class="nara-card">
                    <div class="nara-poster-wrapper">
                        <span class="nara-rank">{{ $index + 1 }}</span>
                        <img src="{{ $item->poster ?? 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?w=300' }}" alt="{{ $item->judul }}" class="nara-poster" />
                    </div>
                    <div class="nara-card-info">
                        <h3 class="nara-card-title">{{ $item->judul }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Section 2: Top 10 TV Shows -->
    <section class="nara-section" id="tv-section">
        <h2 class="nara-section-title">10 Acara TV Teratas di Indonesia Hari Ini</h2>
        <div class="nara-slider">
            @foreach($topTvShows as $index => $item)
                <div class="nara-card">
                    <div class="nara-poster-wrapper">
                        <span class="nara-rank">{{ $index + 1 }}</span>
                        <img src="{{ $item->poster ?? 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?w=300' }}" alt="{{ $item->judul }}" class="nara-poster" />
                    </div>
                    <div class="nara-card-info">
                        <h3 class="nara-card-title">{{ $item->judul }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Section 3: Film & Acara TV Grid -->
    <section class="nara-section" id="all-media-section">
        <h2 class="nara-section-title">Film & Acara Tv</h2>
        <div class="nara-grid">
            @foreach($allMedia as $item)
                <div class="nara-card">
                    <div class="nara-poster-wrapper">
                        <span class="nara-badge">WEBDL</span>
                        <img src="{{ $item->poster ?? 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?w=300' }}" alt="{{ $item->judul }}" class="nara-poster" />
                    </div>
                    <div class="nara-card-info">
                        <h3 class="nara-card-title">{{ $item->judul }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
