# Aplikasi Booking + CRM Berbasis Laravel untuk Ell's Salon

## Daftar Isi

* [Tentang Proyek](#tentang-proyek)

  * [Teknologi yang Digunakan](#teknologi-yang-digunakan)
  * [Dokumentasi Proyek](#dokumentasi-proyek)
* [Fitur](#fitur)
* [Menggunakan Queue](#menggunakan-queue)
* [Instalasi](#instalasi)

## Tentang Proyek

Proyek ini adalah sistem booking dan CRM untuk Ell's Salon, sebuah salon rambut fiktif.

Beberapa fitur utama dari proyek ini meliputi:

* Manajemen pengguna
* Manajemen layanan dan lokasi salon
* Keranjang belanja untuk pelanggan
* Pemesanan janji temu
* Dukungan multi-kategori dan multi-lokasi
* Pengiriman notifikasi email
* Pencatatan statistik tampilan halaman (analytics)
* Manajemen janji temu
* Tampilan data analitik

Jika Anda ingin menjalankan proyek ini secara lokal, ikuti [instruksi instalasi](#instalasi).

### Teknologi yang Digunakan

Proyek ini dibangun menggunakan [TALL Stack](https://tallstack.dev/):

* [Tailwind CSS](https://tailwindcss.com/)
* [Alpine.js](https://alpinejs.dev/)
* [Laravel](https://laravel.com/)
* [Livewire](https://laravel-livewire.com/)

Untuk autentikasi, digunakan [Laravel Jetstream](https://jetstream.laravel.com/).

Proyek ini juga menggunakan [Queued Jobs Laravel](https://laravel.com/docs/10.x/queues) untuk pengiriman email dan pencatatan data analitik.

Untuk pengujian pengiriman email digunakan layanan [Mailtrap](https://mailtrap.io/).

## Menggunakan Queue

Sistem ini menggunakan queued jobs untuk tugas-tugas seperti pencatatan tampilan halaman dan pengiriman email.

Untuk menjalankan queue secara manual, gunakan perintah berikut:

```sh
php artisan queue:listen
```

Info lebih lanjut: [https://laravel.com/docs/10.x/queues](https://laravel.com/docs/10.x/queues)

## Instalasi

### Prasyarat

Pastikan Anda sudah menginstal:

* [Composer](https://getcomposer.org/download/)
* [Node.js](https://nodejs.org/en/download/)
* [NPM](https://www.npmjs.com/get-npm)
* [PHP](https://www.php.net/downloads.php)
* [MySQL](https://dev.mysql.com/downloads/installer/)

> 💡 Anda bisa menggunakan paket XAMPP atau WAMP yang sudah mencakup PHP dan MySQL:
>
> * [XAMPP](https://www.apachefriends.org/download.html)
> * [WAMP](https://www.wampserver.com/en/download-wampserver-64bits/)

### Langkah Instalasi

1. Clone repository:

   ```sh
   git clone https://github.com/sachintha-lk/CRM-laravel
   ```

2. Masuk ke direktori proyek:

   ```sh
   cd CRM-laravel
   ```

3. Install dependensi Composer:

   ```sh
   composer install
   ```

4. Install dependensi NPM:

   ```sh
   npm install
   ```

5. Salin file `.env.example` menjadi `.env`:

   ```sh
   cp .env.example .env
   ```

6. Generate kunci enkripsi aplikasi:

   ```sh
   php artisan key:generate
   ```

7. Buat database baru di MySQL, lalu sesuaikan konfigurasi koneksi di file `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database_anda
   DB_USERNAME=root
   DB_PASSWORD=isi_dengan_password_mysql_anda
   ```

8. Jalankan migrasi untuk membuat struktur tabel:

   ```sh
   php artisan migrate
   ```

9. Jalankan seeder untuk mengisi data awal (termasuk admin):

   ```sh
   php artisan db:seed
   ```

10. Jalankan project:

    Di satu terminal:

    ```sh
    npm run dev
    ```

    Di terminal lain:

    ```sh
    php artisan serve
    ```

11. Buka browser dan kunjungi `http://localhost:8000`

**Akun Admin Default**
Email: `admin@admin.com`
Password: `adminpassword`

### Catatan Tambahan

* Pastikan Anda sudah mengatur layanan email di file `.env`. Untuk keperluan pengujian, Anda dapat menggunakan [Mailtrap](https://mailtrap.io/).
* Untuk fitur pengiriman email dan pencatatan tampilan halaman, pastikan queue dijalankan. Jalankan perintah:

```sh
php artisan queue:listen
```
