<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Cara Menjalankan Proyek Ini di Komputer Lokal

**1. Clone Repository**
Buka terminal/Command Prompt, lalu jalankan perintah berikut untuk mengunduh proyek dari GitHub:
```bash
git clone <MASUKKAN_URL_GITHUB_DI_SINI>
```
*(Ganti `<MASUKKAN_URL_GITHUB_DI_SINI>` dengan link repository GitHub kamu)*

**2. Masuk ke Folder Proyek**
Pindah ke direktori proyek yang baru saja diunduh:
```bash
cd dynasties-7
```

**3. Install Dependency Laravel**
Karena file *library* pendukung tidak diunggah ke GitHub, kamu harus menginstalnya sendiri menggunakan Composer:
```bash
composer install
```

**4. Buat File Konfigurasi (.env)**
Salin file konfigurasi bawaan Laravel:
- Jika menggunakan **Windows (Command Prompt/PowerShell)**:
  ```cmd
  copy .env.example .env
  ```
- Jika menggunakan **Mac/Linux/Git Bash**:
  ```bash
  cp .env.example .env
  ```

**5. Generate Application Key**
Buat kunci keamanan unik untuk aplikasi ini:
```bash
php artisan key:generate
```

**6. Atur Database di File `.env`**
Buka file `.env` menggunakan teks editor (seperti VS Code atau Notepad), lalu cari bagian konfigurasi database dan sesuaikan dengan database di komputermu (misalnya menggunakan XAMPP/MySQL):
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_kamu
DB_USERNAME=root
DB_PASSWORD=
```
*(Pastikan kamu sudah membuat database kosong di phpMyAdmin atau MySQL dengan nama yang sama persis seperti di `DB_DATABASE`)*.

**7. Jalankan Migrasi Database (dan Seeder)**
Buat tabel-tabel yang dibutuhkan di database dan masukkan data awal (seperti akun admin) dengan perintah:
```bash
php artisan migrate --seed
```

**8. Jalankan Server**
Nyalakan *local server* agar aplikasi bisa diakses:
```bash
php artisan serve
```
Buka browser atau Postman dan akses: `http://127.0.0.1:8000`

---

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
