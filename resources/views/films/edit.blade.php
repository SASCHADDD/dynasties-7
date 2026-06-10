<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Film | {{ $film->judul }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { 
            --primary: #e50914; 
            --bg: #121212; 
            --card: #1e1e1e; 
            --text: #ffffff; 
            --border: #333; 
            --input-bg: #2a2a2a;
        }

        body { 
            background-color: var(--bg); 
            color: var(--text); 
            font-family: 'Inter', sans-serif; 
            margin: 0; 
            padding: 40px 20px; 
        }
        
        .container { 
            max-width: 650px; 
            margin: 0 auto; 
            background: var(--card); 
            padding: 40px; 
            border-radius: 12px; 
            border: 1px solid var(--border); 
            box-shadow: 0 10px 30px rgba(0,0,0,0.5); 
        }
        
        h1 { 
            margin: 0 0 30px 0; 
            font-size: 1.8rem; 
            border-left: 4px solid var(--primary); 
            padding-left: 15px; 
            line-height: 1.2;
        }

        h1 span {
            display: block;
            font-size: 0.9rem;
            color: #888;
            font-weight: 400;
            margin-top: 5px;
        }
        
        .form-group { margin-bottom: 20px; }
        label { 
            display: block; 
            margin-bottom: 8px; 
            color: #b3b3b3; 
            font-size: 0.85rem; 
            font-weight: 600; 
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        input, select, textarea { 
            width: 100%; 
            padding: 14px; 
            background: var(--input-bg); 
            border: 1px solid #444; 
            color: white; 
            border-radius: 6px; 
            box-sizing: border-box; 
            transition: all 0.3s ease;
            font-family: inherit;
        }

        input:focus, select:focus, textarea:focus { 
            outline: none; 
            border-color: var(--primary); 
            background: #333; 
            box-shadow: 0 0 0 2px rgba(229, 9, 20, 0.2);
        }
        
        .btn-submit { 
            background-color: var(--primary); 
            color: white; 
            padding: 16px; 
            border: none; 
            border-radius: 6px; 
            cursor: pointer; 
            width: 100%; 
            font-weight: 700; 
            font-size: 1rem; 
            margin-top: 10px; 
            transition: 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-submit:hover { 
            background-color: #ff0a16; 
            transform: translateY(-2px); 
            box-shadow: 0 5px 15px rgba(229, 9, 20, 0.4);
        }

        .btn-submit:active { transform: translateY(0); }
        
        .btn-back { 
            display: inline-block; 
            margin-bottom: 25px; 
            color: #aaa; 
            text-decoration: none; 
            font-size: 0.9rem; 
            transition: 0.2s; 
        }
        
        .btn-back:hover { color: #fff; }

        .grid-half {
            display: grid; 
            grid-template-columns: 1fr 1fr; 
            gap: 20px;
        }

        /* Styling khusus untuk textarea scrollbar */
        textarea::-webkit-scrollbar { width: 8px; }
        textarea::-webkit-scrollbar-track { background: #1a1a1a; }
        textarea::-webkit-scrollbar-thumb { background: #444; border-radius: 4px; }
    </style>
</head>
<body>

<div class="container">
    <a href="/admin" class="btn-back">← Kembali ke Dashboard</a>
    <h1>
        Edit Film
        <span>Sedang menyunting: {{ $film->judul }}</span>
    </h1>
    
    <form action="{{ route('films.update', $film->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Judul Film</label>
            <input type="text" name="judul" value="{{ $film->judul }}" required placeholder="Contoh: Inception">
        </div>
        
        <div class="form-group">
            <label>Genre</label>
            <select name="genre_id" required>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ $film->genre_id == $genre->id ? 'selected' : '' }}>
                        {{ $genre->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Tipe Konten</label>
            <select name="tipe" required>
                <option value="film" {{ $film->tipe == 'film' ? 'selected' : '' }}>Film</option>
                <option value="acara_tv" {{ $film->tipe == 'acara_tv' ? 'selected' : '' }}>Acara TV</option>
            </select>
        </div>

        <div class="form-group">
            <label>Deskripsi / Sinopsis</label>
            <textarea name="deskripsi" rows="5" placeholder="Masukkan ringkasan cerita film...">{{ $film->deskripsi }}</textarea>
        </div>

        <div class="grid-half">
            <div class="form-group">
                <label>Tahun Rilis</label>
                <input type="number" name="tahun_rilis" value="{{ $film->tahun_rilis }}" placeholder="Contoh: 2024">
            </div>
            <div class="form-group">
                <label>Durasi (Menit)</label>
                <input type="number" name="durasi" value="{{ $film->durasi }}" placeholder="Contoh: 120">
            </div>
        </div>

        <div class="form-group">
            <label>URL Poster (Link Gambar)</label>
            <input type="text" name="poster" value="{{ $film->poster }}" placeholder="https://image-link.com/poster.jpg">
        </div>

        <div class="form-group">
            <label>URL Video (Embed Link)</label>
            <input type="text" name="url_video" value="{{ $film->url_video }}" placeholder="https://www.youtube.com/embed/...">
        </div>

        <button type="submit" class="btn-submit">Perbarui Data Film</button>
    </form>
</div>

</form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    // 1. Rekam data asli dari database saat halaman pertama kali dimuat
    const form = document.querySelector('form');
    const dataAwal = {
        judul: form.judul.value.trim(),
        genre_id: form.genre_id.value,
        tipe: form.tipe.value,
        deskripsi: form.deskripsi.value.trim(),
        tahun_rilis: form.tahun_rilis.value.trim(),
        durasi: form.durasi.value.trim(),
        poster: form.poster.value.trim(),
        url_video: form.url_video.value.trim()
    };

    form.addEventListener('submit', function(e) {
        // 2. Ambil data terbaru di form saat tombol perbarui diklik
        const dataSekarang = {
            judul: form.judul.value.trim(),
            genre_id: form.genre_id.value,
            tipe: form.tipe.value,
            deskripsi: form.deskripsi.value.trim(),
            tahun_rilis: form.tahun_rilis.value.trim(),
            durasi: form.durasi.value.trim(),
            poster: form.poster.value.trim(),
            url_video: form.url_video.value.trim()
        };

        // 3. Bandingkan apakah ada field yang berubah nilainya
        const apakahBerubah = Object.keys(dataAwal).some(key => dataAwal[key] !== dataSekarang[key]);

        // Jika semua field nilainya persis sama seperti data awal database
        if (!apakahBerubah) {
            e.preventDefault(); // Batalkan pengiriman ke backend controller
            
            Swal.fire({
                icon: 'info',
                title: 'Tidak Ada Perubahan',
                text: 'Anda belum mengubah data apa pun pada form ini!',
                background: '#1e1e1e',
                color: '#fff',
                confirmButtonColor: '#444'
            });
        }
    });
    </script>
    </body>
</html>

</body>
</html>