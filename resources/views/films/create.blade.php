<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Film Baru</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #e50914; --bg: #121212; --card: #1e1e1e; --text: #ffffff; --border: #333; }
        body { background-color: var(--bg); color: var(--text); font-family: 'Inter', sans-serif; margin: 0; padding: 40px 20px; }
        
        .container { max-width: 650px; margin: 0 auto; background: var(--card); padding: 40px; border-radius: 12px; border: 1px solid var(--border); box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        
        h1 { margin: 0 0 30px 0; font-size: 1.8rem; border-left: 4px solid var(--primary); padding-left: 15px; }
        
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; color: #b3b3b3; font-size: 0.9rem; font-weight: 600; }
        
        input, select, textarea { 
            width: 100%; padding: 14px; background: #2a2a2a; border: 1px solid #444; 
            color: white; border-radius: 6px; box-sizing: border-box; transition: 0.3s;
        }
        input:focus, select:focus, textarea:focus { outline: none; border-color: var(--primary); background: #333; }
        
        .btn-submit { 
            background-color: var(--primary); color: white; padding: 14px; border: none; 
            border-radius: 6px; cursor: pointer; width: 100%; font-weight: 700; 
            font-size: 1rem; margin-top: 10px; transition: 0.3s;
        }
        .btn-submit:hover { background-color: #ff0a16; transform: translateY(-2px); }
        
        .btn-back { display: inline-block; margin-bottom: 25px; color: #aaa; text-decoration: none; font-size: 0.9rem; transition: 0.2s; }
        .btn-back:hover { color: #fff; }
    </style>
</head>
<body>

<div class="container">
    <a href="/admin" class="btn-back">← Kembali ke Dashboard</a>
    <h1>Tambah Film Baru</h1>

    @if ($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('films.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Judul Film</label>
            <input type="text" name="judul" required placeholder="Masukkan judul film...">
        </div>
        
        <div class="form-group">
            <label>Genre</label>
            <select name="genre_id" required> {{-- REVISI: name dikembalikan ke genre_id --}}
                <option value="">-- Pilih Genre --</option>
                {{-- REVISI: value diisi ID angka (1-5) sesuai database --}}
                <option value="1">Drama</option>
                <option value="2">Horor</option>
                <option value="3">Comedy</option>
                <option value="4">Action</option>
                <option value="5">Romance</option>
            </select>
        </div>

        <div class="form-group">
            <label>Tipe Konten</label>
            <select name="tipe" required>
                <option value="film">Film</option>
                <option value="acara_tv">Acara TV</option>
            </select>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="4" placeholder="Ceritakan sinopsis singkat film..."></textarea>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
            <div class="form-group">
                <label>Tahun Rilis</label>
                <input type="number" name="tahun_rilis" placeholder="2026">
            </div>
            <div class="form-group">
                <label>Durasi (Menit)</label>
                <input type="number" name="durasi" placeholder="120">
            </div>
        </div>

        <div class="form-group">
            <label>URL Poster</label>
            <input type="text" name="poster" placeholder="https://link-gambar.com/poster.jpg">
        </div>

        <div class="form-group">
            <label>URL Video</label>
            <input type="text" name="url_video" placeholder="https://youtube.com/embed/...">
        </div>

        <button type="submit" class="btn-submit">Simpan Data Film</button>
    </form>
</div>

    </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    document.querySelector('form').addEventListener('submit', function(e) {
        // Ambil nilai dari field form
        const deskripsi = document.querySelector('textarea[name="deskripsi"]').value.trim();
        const tahunRilis = document.querySelector('input[name="tahun_rilis"]').value.trim();
        const durasi = document.querySelector('input[name="durasi"]').value.trim();
        const poster = document.querySelector('input[name="poster"]').value.trim();
        const urlVideo = document.querySelector('input[name="url_video"]').value.trim();

        let formKosong = [];

        // Cek field mana saja yang masih kosong
        if (!deskripsi) formKosong.push("Deskripsi / Sinopsis");
        if (!tahunRilis) formKosong.push("Tahun Rilis");
        if (!durasi) formKosong.push("Durasi");
        if (!poster) formKosong.push("URL Poster");
        if (!urlVideo) formKosong.push("URL Video");

        // Jika ada form yang belum diisi, interupsi proses simpan
        if (formKosong.length > 0) {
            e.preventDefault(); // Mencegah form ke-refresh / terkirim
            
            Swal.fire({
                icon: 'warning',
                title: 'Form Belum Lengkap',
                html: `Gagal menyimpan! Field berikut masih kosong:<br><b style="color: #e50914;">${formKosong.join(', ')}</b>`,
                background: '#1e1e1e',
                color: '#fff',
                confirmButtonColor: '#e50914'
            });
        }
    });
    </script>
    </body>
    </html>
</body>
</html>