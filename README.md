🏢 HR Portal (Sistem Penerimaan Pegawai)

Sistem manajemen rekrutmen sederhana yang dibangun menggunakan Laravel 12 dan Bootstrap 5. Aplikasi ini memungkinkan pelamar untuk melamar pekerjaan dan Admin untuk mengelola lowongan serta melakukan seleksi.

🚀 Fitur Utama

👥 Role: Guest (Pelamar)

Melihat daftar lowongan pekerjaan yang tersedia.

Melamar pekerjaan dengan mengunggah CV (PDF).

Form lamaran yang valid dan aman.

🛡️ Role: Admin (HRD)

Dashboard Informatif: Ringkasan statistik pelamar dan kuota per departemen.

Master Data: CRUD (Create, Read, Update, Delete) untuk Lowongan dan Departemen.

Approval System: Menerima atau menolak pelamar.

Reporting: Laporan otomatis sisa kuota dan status penerimaan.

Cetak Laporan: Fitur print report ke PDF.

🛠️ Teknologi yang Digunakan

Framework: Laravel 12

Database: MySQL

Frontend: Blade Templates + Bootstrap 5

Styling: Custom CSS (Modern Clean UI)

⚙️ Cara Instalasi (Run Locally)

Ikuti langkah ini untuk menjalankan proyek di komputer Anda:

Clone Repositori

git clone [https://github.com/RahmatullahWiryaAdikusuma/laravel-hr-portal.git](https://github.com/RahmatullahWiryaAdikusuma/laravel-hr-portal.git)
cd laravel-hr-portal


Install Dependencies

composer install


Setup Environment
Salin file .env.example menjadi .env:

cp .env.example .env


Buka file .env dan sesuaikan konfigurasi database:

DB_DATABASE=nama_database_anda
DB_USERNAME=root
DB_PASSWORD=


Generate Key & Migrasi

php artisan key:generate
php artisan migrate:fresh --seed


(Perintah --seed akan otomatis membuat akun Admin & Data Dummy)

Jalankan Server

php artisan serve


Buka browser di: http://localhost:8000

🔑 Akun Demo

Gunakan akun ini untuk login:

Role

Email

Password

Admin

admin@test.com

password123

Guest

guest@test.com

password123
