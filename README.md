# F-01 Authentication & Admin Dashboard — Laravel 13.5

Starter project untuk modul autentikasi alumni dan dashboard administrator. Memerlukan PHP **8.3+**, Composer, ekstensi `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `fileinfo`, serta MySQL/MariaDB.

## Instalasi (XAMPP / lokal)
1. Ekstrak ZIP ke folder proyek, misalnya `C:\xampp\htdocs\f01-alumni`.
2. Buat database MySQL bernama `f01_alumni` (collation `utf8mb4_unicode_ci`).
3. Salin `.env.example` menjadi `.env`; sesuaikan koneksi database dan SMTP. Untuk uji lokal tanpa SMTP, `MAIL_MAILER=log` akan menulis email ke `storage/logs/laravel.log`.
4. Jalankan dari terminal di folder proyek:
   ```bash
   composer install
   php artisan key:generate
   php artisan migrate --seed
   php artisan serve
   ```
5. Buka `http://127.0.0.1:8000`.

## Akun administrator awal
Nilai default `.env.example`: `admin@example.test` / `ChangeMe123!`. **Ganti ADMIN_EMAIL dan ADMIN_PASSWORD sebelum seeding pada lingkungan selain lokal.** Seeder hanya membuat akun jika email tersebut belum ada.

## Catatan fitur
- Registrasi alumni menghasilkan akun `pending`; akses dashboard alumni hanya setelah email terverifikasi dan status akun `approved`.
- Administrator dapat menyetujui, menolak, menonaktifkan akun, dan mengubah role pada menu Manajemen Pengguna.
- Verifikasi email aktif melalui event `Registered` dan implementasi `MustVerifyEmail`.
- Reset password menggunakan broker Laravel; konfigurasi SMTP untuk pengiriman email di lingkungan nyata.
- Moderasi konten dan manajemen profil belum diimplementasikan karena belum ada modul konten/profil dalam scope source ini.

## Pengujian
```bash
php artisan test
```
Pengujian menggunakan SQLite in-memory; pastikan ekstensi `pdo_sqlite` tersedia.

## Keamanan produksi
Set `APP_ENV=production`, `APP_DEBUG=false`, gunakan HTTPS, SMTP yang valid, password administrator kuat, dan jangan commit `.env`. Tambahkan kebijakan persetujuan alumni yang terhubung ke sumber data alumni resmi sebelum peluncuran.
