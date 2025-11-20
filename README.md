<div align="center">

🏢 HR Portal

Sistem Informasi Rekrutmen & Seleksi Pegawai

<p>
<a href="https://laravel.com">
<img src="https://www.google.com/search?q=https://img.shields.io/badge/Laravel-12.x-FF2D20%3Fstyle%3Dfor-the-badge%26logo%3Dlaravel%26logoColor%3Dwhite" alt="Laravel" />
</a>
<a href="https://getbootstrap.com">
<img src="https://www.google.com/search?q=https://img.shields.io/badge/Bootstrap-5-7952B3%3Fstyle%3Dfor-the-badge%26logo%3Dbootstrap%26logoColor%3Dwhite" alt="Bootstrap" />
</a>
<a href="https://www.php.net">
<img src="https://www.google.com/search?q=https://img.shields.io/badge/PHP-8.2-777BB4%3Fstyle%3Dfor-the-badge%26logo%3Dphp%26logoColor%3Dwhite" alt="PHP" />
</a>
</p>

<p>
Sistem manajemen rekrutmen modern yang memudahkan perusahaan dalam mengelola lowongan pekerjaan dan proses seleksi pelamar secara efisien.
</p>

<!-- GANTI LINK GAMBAR DI BAWAH INI DENGAN SCREENSHOT ASLI APLIKASIMU NANTI -->

<!-- Contoh: src="docs/dashboard.png" -->

<img src="https://www.google.com/search?q=https://placehold.co/800x400/4361ee/ffffff%3Ftext%3DDashboard%2BPreview" alt="Dashboard Preview" width="100%" style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">

</div>

🌟 Fitur Utama

Aplikasi ini memiliki dua peran pengguna dengan hak akses yang berbeda:

👨‍💼 Admin (HRD)

Dashboard Informatif: Statistik visual jumlah pelamar, status penerimaan, dan kuota departemen.

Manajemen Data Master: CRUD (Create, Read, Update, Delete) data Lowongan & Departemen.

Sistem Seleksi: Fitur Approval (Terima/Tolak) lamaran masuk.

Laporan Otomatis: Rekapitulasi sisa kuota dan status pelamar yang dapat dicetak.

UI Modern: Tampilan Sidebar responsif dan desain yang bersih.

🧑‍💻 Guest (Pelamar)

Katalog Lowongan: Melihat daftar lowongan pekerjaan yang tersedia.

Form Lamaran: Mengisi biodata dan mengunggah CV (PDF).

Validasi Data: Validasi input yang aman dan user-friendly.

📸 Tampilan Aplikasi

Dashboard Admin

Form Pelamar

<img src="https://www.google.com/search?q=https://placehold.co/600x400/eaf0ff/4361ee%3Ftext%3DDashboard" alt="Dashboard" width="400"/>

<img src="https://www.google.com/search?q=https://placehold.co/600x400/eaf0ff/4361ee%3Ftext%3DForm%2BApply" alt="Form Apply" width="400"/>

Laporan & Approval

Manajemen Lowongan

<img src="https://www.google.com/search?q=https://placehold.co/600x400/eaf0ff/4361ee%3Ftext%3DApproval" alt="Approval" width="400"/>

<img src="https://www.google.com/search?q=https://placehold.co/600x400/eaf0ff/4361ee%3Ftext%3DCRUD%2BMaster" alt="Master Data" width="400"/>

(Tip: Ganti link gambar di atas dengan screenshot asli aplikasimu agar lebih menarik!)

⚙️ Panduan Instalasi (Local)

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di komputer Anda:

1. Clone Repositori

git clone [https://github.com/RahmatullahWiryaAdikusuma/laravel-hr-portal.git](https://github.com/RahmatullahWiryaAdikusuma/laravel-hr-portal.git)
cd laravel-hr-portal


2. Install Dependencies

Pastikan Anda sudah menginstall Composer dan Node.js.

composer install
npm install && npm run build


3. Konfigurasi Environment

Salin file .env.example menjadi .env:

cp .env.example .env


Buka file .env dan sesuaikan pengaturan database Anda:

DB_DATABASE=hr_portal_db
DB_USERNAME=root
DB_PASSWORD=


4. Generate Key & Migrasi Database

php artisan key:generate
php artisan migrate:fresh --seed


Catatan: Perintah --seed sangat penting karena akan membuat akun Admin otomatis dan data dummy pelamar.

5. Jalankan Server

php artisan serve


Akses aplikasi di browser melalui: http://localhost:8000

🔐 Akun Demo

Gunakan kredensial berikut untuk mencoba aplikasi:

Role

Email

Password

Akses

Admin

admin@test.com

password123

Full Akses, CRUD, Approval

Guest

guest@test.com

password123

Lihat Lowongan, Melamar

🛠️ Teknologi

Backend: Laravel 12

Frontend: Blade, Bootstrap 5, Custom CSS

Database: MySQL

Font: Plus Jakarta Sans & Inter

<div align="center">
<small>Dibuat dengan  Laravel </small>
</div>
