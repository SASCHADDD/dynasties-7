<!DOCTYPE html>
<html>
<head>
    <title>Kelola Film</title>
    <style>
        body { background-color: #121212; color: #e0e0e0; font-family: sans-serif; padding: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .btn-add { background-color: #e50914; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; }
        .film-card { background-color: #1f1f1f; padding: 20px; margin-bottom: 15px; border-radius: 8px; border-left: 5px solid #e50914; }
        .film-title { color: #ffffff; font-size: 1.5rem; font-weight: bold; margin-bottom: 5px; }
        .film-desc { color: #b3b3b3; }
        .badge { background-color: #e50914; color: white; padding: 5px 10px; border-radius: 4px; float: right; font-size: 0.8rem; }
    </style>
</head>
<body>

<div class="header">
    <h1>Kelola Film</h1>
    <a href="/films/create" class="btn-add">Tambah Film</a>
</div>

@foreach($films as $film)
    <div class="film-card">
        <span class="badge">Film</span>
        <div class="film-title">{{ $film->judul }}</div>
        <p class="film-desc">{{ Str::limit($film->deskripsi, 100) }}</p>
    </div>
@endforeach

</body>
</html>