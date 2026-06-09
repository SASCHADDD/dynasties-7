<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { background: url('background-film.jpg'); background-size: cover; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: rgba(0, 0, 0, 0.8); padding: 40px; border-radius: 10px; color: white; width: 350px; }
        input { width: 100%; margin: 10px 0; padding: 10px; background: #333; border: none; color: white; }
        button { width: 100%; padding: 10git stashpx; background: #e50914; border: none; color: white; cursor: pointer; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <form action="/login" method="POST">
            @csrf
            <input type="text" name="nama_pengguna" placeholder="Username" required>
            <input type="password" name="kata_sandi" placeholder="Password" required>
            <button type="submit">Sign in</button>
        </form>
        <p>Belum punya akun? <a href="/register">Daftar di sini</a></p>
    </div>
</body>
</html>