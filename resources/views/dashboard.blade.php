@extends('layouts.app')

@section('title', 'Home')

@section('content')
<style>
    :root { 
        --primary: #e50914; 
        --bg: #121212; 
        --surface: #1e1e1e; 
        --border: #333; 
        --text: #e0e0e0; 
    }

    .nara-container { 
        max-width: 1100px; 
        margin: 0 auto; 
        padding: 40px 20px; 
    }

    .nara-section { 
        margin-bottom: 50px; 
    }

    .nara-section-title { 
        color: #fff; 
        font-size: 1.6rem;
        font-weight: 700;
        margin-bottom: 25px;
        border-left: 4px solid var(--primary);
        padding-left: 15px;
        line-height: 1.2;
    }

    /* Grid Layout Responsif */
    .nara-grid { 
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 25px;
    }

    /* Premium Card Design */
    .nara-card { 
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.4);
        transition: transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1), border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .nara-card:hover {
        transform: translateY(-5px);
        border-color: var(--primary);
        box-shadow: 0 8px 25px rgba(229, 9, 20, 0.3);
    }

    .nara-poster-wrapper { 
        position: relative;
        width: 100%;
        aspect-ratio: 2 / 3; 
        overflow: hidden;
        background: #1a1a1a;     }

    .nara-poster { 
        width: 100%;
        height: 100%; 
        object-fit: cover; 
        object-position: center; 
        transition: transform 0.5s ease;
    }

    .nara-card:hover .nara-poster {
        transform: scale(1.05);
    }

    .nara-card-info { 
        padding: 15px; 
    }

    .nara-card-title { 
        margin: 0;
        font-size: 0.95rem;
        font-weight: 600;
        color: #fff;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 2.7em; /* Membatasi tinggi teks judul agar rapi sejajar */
    }

    .empty-text { 
        color: #888; 
        font-style: italic;
        grid-column: 1 / -1;
        padding: 20px 0;
    }
</style>

<div class="nara-container">
    <section class="nara-section" id="film-section">
        <h2 class="nara-section-title">Film Terbaru</h2>
        <div class="nara-grid">
            @forelse($recentFilms as $item)
                <div class="nara-card">
                    <div class="nara-poster-wrapper">
                        <a href="{{ url('/tonton/' . $item->id) }}">
                            <img src="{{ $item->poster ?? 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?w=300' }}" alt="{{ $item->judul }}" class="nara-poster" />
                        </a>
                    </div>
                    <div class="nara-card-info">
                        <h3 class="nara-card-title">{{ $item->judul }}</h3>
                    </div>
                </div>
            @empty
                <p class="empty-text">Belum ada data film terbaru.</p>
            @endforelse
        </div>
    </section>

    <section class="nara-section" id="tv-section">
        <h2 class="nara-section-title">Acara TV Terbaru</h2>
        <div class="nara-grid">
            @forelse($recentTvShows as $item)
                <div class="nara-card">
                    <div class="nara-poster-wrapper">
                        <a href="{{ url('/tonton/' . $item->id) }}">
                            <img src="{{ $item->poster ?? 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?w=300' }}" alt="{{ $item->judul }}" class="nara-poster" />
                        </a>
                    </div>
                    <div class="nara-card-info">
                        <h3 class="nara-card-title">{{ $item->judul }}</h3>
                    </div>
                </div>
            @empty
                <p class="empty-text">Belum ada data acara TV terbaru.</p>
            @endforelse
        </div>
    </section>
</div>
@endsection