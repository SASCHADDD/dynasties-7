<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Dynasties-7</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Palet warna premium, diselaraskan dengan dashboard pengguna */
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
            padding: 40px 20px; 
        }

        .container { 
            max-width: 1100px; 
            margin: 0 auto; 
        }
        
        /* Header dengan aksen garis vertikal merah khas Dynasties-7 */
        .header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 35px; 
        }

        .header h1 { 
            color: #fff; 
            font-size: 1.8rem;
            font-weight: 700;
            border-left: 4px solid var(--primary);
            padding-left: 15px;
            margin: 0;
            line-height: 1.2;
        }
        
        .btn-add { 
            background: var(--primary); 
            color: white; 
            padding: 12px 24px; 
            text-decoration: none; 
            border-radius: 6px; 
            font-weight: 600; 
            font-size: 0.95rem;
            transition: all 0.2s ease; 
            box-shadow: 0 4px 15px rgba(229, 9, 20, 0.3);
        }

        .btn-add:hover { 
            background: #ff0a16; 
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(229, 9, 20, 0.4);
        }
        
        /* Styling Tabel */
        .table-container { 
            background: var(--surface); 
            border-radius: 12px; 
            overflow: hidden; 
            border: 1px solid var(--border); 
            box-shadow: 0 10px 30px rgba(0,0,0,0.6); 
        }

        table { 
            width: 100%; 
            border-collapse: collapse; 
            text-align: left;
        }

        th { 
            background: #252525; 
            padding: 20px; 
            color: var(--text-muted); 
            font-size: 0.8rem; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
            border-bottom: 1px solid var(--border);
        }

        td { 
            padding: 20px; 
            border-bottom: 1px solid #2a2a2a; 
            font-size: 0.95rem;
            vertical-align: middle;
        }

        tr:hover { 
            background: #252525; 
        }

        /* Badge Genre Premium */
        .genre-badge {
            background: #2a2a2a; 
            color: #fff;
            padding: 6px 12px; 
            border-radius: 4px; 
            font-size: 0.8rem;
            font-weight: 600;
            border: 1px solid #444;
            display: inline-block;
        }

        /* FIX CONTAINER AKSI: Mencegah tombol bertumpukan/nimpa */
        .action-group {
            display: flex;
            align-items: center;
            gap: 10px; /* Jarak aman konstan antar tombol */
            flex-wrap: nowrap; /* Memaksa tombol tetap satu baris lurus */
        }
        
        /* Tombol Aksi Kotak */
        .btn-action { 
            padding: 8px 16px; 
            border-radius: 4px; 
            font-size: 0.85rem; 
            font-weight: 600; 
            text-decoration: none; 
            border: 1px solid transparent; 
            transition: all 0.2s ease; 
            box-sizing: border-box;
            white-space: nowrap; /* Mencegah teks tombol terpotong ke bawah */
        }

        .btn-edit { 
            background: #ffffff; 
            color: #000000; 
            border-color: #fff; 
        }

        .btn-edit:hover { 
            background: #e0e0e0; 
            border-color: #ccc; 
            transform: translateY(-1px);
        }

        .btn-delete { 
            background: #3d1a1a; 
            color: #ff6b6b; 
            border-color: #552a2a; 
            cursor: pointer; 
        }

        .btn-delete:hover { 
            background: var(--primary); 
            color: white; 
            border-color: var(--primary); 
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(229, 9, 20, 0.3);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Admin Dashboard</h1>
        <a href="/films/create" class="btn-add">+ Tambah Film</a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Judul Film / Acara TV</th>
                    <th>Tahun</th>
                    <th>Durasi</th>
                    <th>Genre</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($films as $film)
                <tr>
                    <td style="font-weight: 600; color: #fff;">{{ $film->judul }}</td>
                    <td>{{ $film->tahun_rilis ?? '-' }}</td>
                    <td>{{ $film->durasi ? $film->durasi . ' m' : '-' }}</td>
                    <td>
                        <span class="genre-badge">
                            {{ $film->genre->nama ?? 'Umum' }}
                        </span>
                    </td>
                    <td>
                        <div class="action-group">
                            <a href="/films/{{ $film->id }}/edit" class="btn-action btn-edit">Edit</a>
                            
                            <form id="delete-{{$film->id}}" action="{{ route('films.destroy', $film->id) }}" method="POST" style="display: none;">
                                @csrf 
                                @method('DELETE')
                            </form>
                            <button class="btn-action btn-delete" onclick="confirmDelete({{$film->id}})">Hapus</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus konten?',
            text: "Data ini akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e50914',
            cancelButtonColor: '#444',
            background: '#1e1e1e',
            color: '#fff',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-' + id).submit();
            }
        });
    }

    // Notifikasi SweetAlert Sukses Otomatis dari Controller Session
    @if(session('success'))
        Swal.fire({ 
            icon: 'success', 
            title: 'Berhasil', 
            text: "{{ session('success') }}", 
            background: '#1e1e1e', 
            color: '#fff',
            confirmButtonColor: '#e50914'
        });
    @endif
</script>
</body>
</html>