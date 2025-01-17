## SehatPol
Website Poliklinik 

## Persyaratan
- PHP 8.2^
- Composer
- Node.js
- Database (MySQL)
- Laravel 11

## Instalasi

1. Clone repositori ini ke dalam komputer lokal Anda:

```
git clone https://github.com/filipusarif/poliklinik-laravel.git
```

```
cd poliklinik-laravel
```

2. Masuk Ke Visual Studio Code

```
code .
```

3. Buka terminal dan instal dependensi menggunakan Composer:

```
composer install
```

4. Copy .env.example ke .env dan konfigurasi sesuai kebutuhan:

```
copy .env.example .env
```

5. Generate application key:

```
php artisan key:generate
```

6. Atur konfigurasi database di file .env sesuai dengan database yang akan digunakan:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=poli
DB_USERNAME=root
DB_PASSWORD=
```

7. Buat database baru dengan nama ``poliklinik-laravel`` di PhpMyAdmin.

8. Jalankan migrasi dan seeder untuk membuat tabel dan data awal:

```
php artisan migrate:fresh --seed
```

9. Build frontend assets

```
npm install
```
10. jalankan server aplikasi
```
composer run dev
```

## Struktur Proyek
- app/Models: Model untuk entitas utama seperti Pasien, Dokter, Jadwal, dll.
- app/Http/Controllers: Berisi controller seperti PasienController, DokterController, PoliController.
- database/migrations - File migrasi untuk membuat tabel.
- database/seeders - Seeder untuk data awal, termasuk pasien, dokter, dan poli.
- resources/views - Berisi file view untuk frontend dan backend.
- routes/web.php - Definisi rute untuk aplikasi web.

- dokter: Akses terbatas pada jadwal pribadi, data pasien yang terkait, dan catatan medis.
- pasien: Dapat mengakses fitur pendaftaran dan melihat riwayat pribadi.

## Akun Default Admin
- No HP 082136676464 Password 12345678
- Semua akun admin, dokter, dan pasien memiliki password default: 12345678
