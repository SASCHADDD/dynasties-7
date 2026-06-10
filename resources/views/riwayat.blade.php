@extends('layouts.app')

@section('title', 'Riwayat Tontonan')

@section('content')
<style>
    :root { 
        --primary: #e50914; 
        --bg: #121212; 
        --surface: #1e1e1e; 
        --border: #333; 
        --text: #e0e0e0; 
    }

    .riwayat-container { 
        max-width: 1000px; 
        margin: 40px auto; 
        padding: 0 20px; 
    }
    
    .riwayat-title {
        color: #fff; 
        margin-bottom: 30px;
        font-size: 1.8rem;
        border-left: 4px solid var(--primary);
        padding-left: 15px;
        line-height: 1.2;
    }

    .table-container { 
        background: var(--surface); 
        border-radius: 12px; 
        overflow: hidden; 
        border: 1px solid var(--border); 
        box-shadow: 0 4px 20px rgba(0,0,0,0.5); 
    }
    
    table { width: 100%; border-collapse: collapse; text-align: left; }
    
    th { 
        background: #252525; 
        padding: 20px; 
        color: #aaa; 
        font-size: 0.8rem; 
        text-transform: uppercase; 
        letter-spacing: 1px; 
    }
    
    td { 
        padding: 20px; 
        border-bottom: 1px solid #2a2a2a; 
        color: var(--text); 
    }
    
    tr:hover { background: #252525; }
    
    /* Progress Bar */
    .progress-bar-container {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .progress-track { 
        background: #333; 
        height: 8px; 
        border-radius: 4px; 
        width: 120px; 
        overflow: hidden;
    }
    
    .progress-fill { 
        background: var(--primary); 
        height: 100%; 
        border-radius: 4px; 
    }

    .progress-text {
        font-size: 0.85rem;
        color: #aaa;
        font-weight: 600;
    }

    .empty-state { 
        text-align: center; 
        padding: 60px 20px; 
        color: #888; 
        font-size: 1rem;
    }
</style>

<div class="riwayat-container">
    <h1 class="riwayat-title">Riwayat Tontonan Anda</h1>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Judul Film / Acara TV</th>
                    <th>Ditonton Pada</th>
                    <th>Progres</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayat as $item)
                <tr>
                    <td style="font-weight: 600; color: #fff;">{{ $item->film->judul ?? 'Konten Tidak Ditemukan' }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->ditonton_pada)->format('d M Y, H:i') }} WIB</td>
                    <td>
                        <div class="progress-bar-container">
                            <div class="progress-track">
                                <div class="progress-fill" style="width: {{ $item->progres }}%;"></div>
                            </div>
                            <span class="progress-text">{{ $item->progres }}%</span>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="empty-state">Belum ada riwayat tontonan. Yuk mulai menonton!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection