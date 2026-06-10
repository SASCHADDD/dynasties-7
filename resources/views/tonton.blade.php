<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nonton {{ $film->judul }} | Dynasties-7</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #e50914;
            --bg: #121212;
            --surface: #1e1e1e;
            --border: #333;
            --text-main: #ffffff;
            --text-muted: #b3b3b3;
        }

        body {
            background-color: var(--bg);
            color: var(--text-main);
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        /* Layout Container */
        .watch-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 40px 20px;
            box-sizing: border-box;
        }

        /* Navigasi Atas */
        .nav-header {
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }

        .btn-back {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: color 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-back:hover {
            color: var(--primary);
        }

        /* Video Player Box */
        .video-wrapper {
            background: #000;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.7);
            aspect-ratio: 16 / 9;
            width: 100%;
            margin-bottom: 30px;
        }

        #player {
            width: 100%;
            height: 100%;
            display: block;
        }

        /* Info Section Card */
        .info-card {
            background-color: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .info-header {
            border-bottom: 1px solid #2a2a2a;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .film-title {
            margin: 0 0 12px 0;
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            line-height: 1.2;
        }

        /* Badges & Meta Tags */
        .meta-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        .badge {
            background-color: #2a2a2a;
            color: var(--text-main);
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: 1px solid #444;
        }

        .badge-type {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .meta-item {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-left: 5px;
        }

        .meta-divider {
            color: #444;
            font-size: 0.9rem;
        }

        /* Description Box */
        .description-section h3 {
            margin: 0 0 10px 0;
            font-size: 1.1rem;
            color: var(--text-main);
            font-weight: 600;
        }

        .film-description {
            margin: 0;
            color: var(--text-muted);
            font-size: 1rem;
            line-height: 1.6;
            text-align: justify;
        }
    </style>
</head>
<body>

<div class="watch-container">
    <header class="nav-header">
        <a href="/dashboard" class="btn-back">← Kembali ke Dashboard</a>
    </header>

    <div class="video-wrapper">
        <div id="player"></div>
    </div>

    <article class="info-card">
        <div class="info-header">
            <h1 class="film-title">{{ $film->judul }}</h1>
            
            <div class="meta-container">
                <span class="badge badge-type">
                    {{ $film->tipe === 'acara_tv' ? 'Acara TV' : 'Film' }}
                </span>
                
                <span class="badge">
                    {{ $film->genre->nama ?? 'Genre Umum' }}
                </span>

                @if($film->tahun_rilis)
                    <span class="meta-divider">|</span>
                    <span class="meta-item">{{ $film->tahun_rilis }}</span>
                @endif

                @if($film->durasi)
                    <span class="meta-divider">|</span>
                    <span class="meta-item">{{ $film->durasi }} Menit</span>
                @endif
            </div>
        </div>

        <div class="description-section">
            <h3>Sinopsis Cerita</h3>
            <p class="film-description">
                {{ $film->deskripsi ?? 'Tidak ada deskripsi sinopsis untuk konten ini.' }}
            </p>
        </div>
    </article>
</div>

<script>
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player;
    var urlVideoAsli = "{{ $film->url_video }}";

    // Pengekstrak ID YouTube otomatis terpadu
    function ekstrakYoutubeId(url) {
        if (!url) return null;
        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        var match = url.match(regExp);
        return (match && match[2].length == 11) ? match[2] : null;
    }

    var videoId = ekstrakYoutubeId(urlVideoAsli);

    function onYouTubeIframeAPIReady() {
        if (!videoId) {
            document.getElementById('player').innerHTML = `
                <div style="display:flex; justify-content:center; align-items:center; height:100%; color:#ff0000; font-weight:bold; background:#1a1a1a;">
                    Format URL Video YouTube tidak didukung atau kosong!
                </div>`;
            return;
        }

        player = new YT.Player('player', {
            videoId: videoId,
            playerVars: {
                'playsinline': 1,
                'rel': 0,
                'autoplay': 0,
                'modestbranding': 1
            },
            events: {
                'onStateChange': onPlayerStateChange
            }
        });
    }

    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PAUSED || event.data == YT.PlayerState.ENDED) {
            simpanRiwayatKeLaravel();
        }
    }

    function simpanRiwayatKeLaravel() {
        if (!player) return;

        var durasiTotal = player.getDuration();
        var waktuSekarang = player.getCurrentTime();

        if (durasiTotal > 0) {
            var hitungProgres = Math.round((waktuSekarang / durasiTotal) * 100);

            fetch("/films/{{ $film->id }}/watch", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ progres: hitungProgres })
            })
            .then(response => response.json())
            .then(data => {
                console.log("Riwayat Otomatis Diperbarui:", data.pesan);
            })
            .catch(error => console.error("Koneksi gagal mengirim riwayat:", error));
        }
    }

    // Mengamankan progres terakhir sesaat sebelum berpindah rute halaman
    window.addEventListener('beforeunload', function () {
        simpanRiwayatKeLaravel();
    });
</script>

</body>
</html>