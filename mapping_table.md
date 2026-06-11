# Mapping Table

| Class Diagram (OOP) | Entity / Table (RDBMS) | Keterangan / Aturan Pemetaan |
| :--- | :--- | :--- |
| **Class `User`** | **Table `user`** | Pemetaan 1:1 antara *class* dan tabel. |
| - `id` | - `id` (PK) | Atribut menjadi kolom *Primary Key*. |
| - `nama_pengguna` | - `nama_pengguna` | Tipe data String menjadi VARCHAR. |
| - `kata_sandi` | - `kata_sandi` | Tipe data String menjadi VARCHAR. |
| - `dibuat_pada` | - `dibuat_pada` | Tipe data Timestamp tetap Timestamp. |
| - `diperbarui_pada` | - `diperbarui_pada` | Tipe data Timestamp tetap Timestamp. |
| | | |
| **Class `Admin`** | **Table `admin`** | Pemetaan 1:1 antara *class* dan tabel. |
| - `id` | - `id` (PK) | Atribut menjadi kolom *Primary Key*. |
| - `nama_pengguna` | - `nama_pengguna` | Tipe data String menjadi VARCHAR. |
| - `kata_sandi` | - `kata_sandi` | Tipe data String menjadi VARCHAR. |
| - `dibuat_pada` | - `dibuat_pada` | Tipe data Timestamp tetap Timestamp. |
| - `diperbarui_pada` | - `diperbarui_pada` | Tipe data Timestamp tetap Timestamp. |
| | | |
| **Class `Genre`** | **Table `genre`** | Pemetaan 1:1 antara *class* dan tabel. |
| - `id` | - `id` (PK) | Atribut menjadi kolom *Primary Key*. |
| - `nama` | - `nama` | Tipe data String menjadi VARCHAR. |
| - `dibuat_pada` | - `dibuat_pada` | Tipe data Timestamp. |
| - `diperbarui_pada` | - `diperbarui_pada` | Tipe data Timestamp. |
| | | |
| **Class `Film`** | **Table `film`** | Pemetaan 1:1 antara *class* dan tabel. |
| - `id` | - `id` (PK) | Atribut menjadi kolom *Primary Key*. |
| *(Relation from Genre)*| - `genre_id` (FK) | Relasi *1-to-many* menghasilkan *Foreign Key* ke tabel `genre`. |
| - `tipe` | - `tipe` | Tipe Enum tetap Enum. |
| - `judul` | - `judul` | Tipe data String menjadi VARCHAR. |
| - `deskripsi` | - `deskripsi` | Tipe data Text tetap Text. |
| - `durasi` | - `durasi` | Tipe data Integer menjadi INT. |
| - `tahun_rilis` | - `tahun_rilis` | Tipe data Integer menjadi INT. |
| - `poster` | - `poster` | Tipe data String menjadi VARCHAR. |
| - `url_video` | - `url_video` | Tipe data String menjadi VARCHAR. |
| - `dibuat_pada` | - `dibuat_pada` | Tipe data Timestamp. |
| - `diperbarui_pada` | - `diperbarui_pada` | Tipe data Timestamp. |
| | | |
| **Class `RiwayatTontonan`**| **Table `riwayat_tontonan`**| Pemetaan 1:1. |
| - `id` | - `id` (PK) | Atribut menjadi kolom *Primary Key*. |
| *(Relation from User)* | - `user_id` (FK) | Relasi *1-to-many* menghasilkan FK ke tabel `user`. |
| *(Relation from Film)* | - `film_id` (FK) | Relasi *1-to-many* menghasilkan FK ke tabel `film`. |
| - `progres` | - `progres` | Tipe data Integer menjadi INT. |
| - `ditonton_pada` | - `ditonton_pada` | Tipe data Timestamp. |

### Pemetaan Relasi (Relationships)
- **Asosiasi `Genre "1" -- "0..*" Film`**: Direalisasikan dengan menambahkan *Foreign Key* `genre_id` pada tabel `film`.
- **Asosiasi `User "1" -- "0..*" RiwayatTontonan`**: Direalisasikan dengan menambahkan *Foreign Key* `user_id` pada tabel `riwayat_tontonan`.
- **Asosiasi `Film "1" -- "0..*" RiwayatTontonan`**: Direalisasikan dengan menambahkan *Foreign Key* `film_id` pada tabel `riwayat_tontonan`.
- **Asosiasi `Admin` dengan `Film` & `Genre` (mengelola)**: Karena ini adalah relasi perilaku (*behavioral / authorization*), relasi ini tidak diwujudkan dalam bentuk relasi *database* (*Foreign Key*), melainkan diselesaikan secara *logical* pada *Business Layer / Controller* dari aplikasi.
