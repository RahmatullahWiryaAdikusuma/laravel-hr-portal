<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\MasterDepartemen;
use App\Models\MasterLowongan;
use App\Models\TransaksiPendaftar;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Login (Admin & Guest)
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@test.com',
            'role' => 'admin',
            'password' => bcrypt('password123'),
        ]);

        User::create([
            'name' => 'Pelamar Magang',
            'email' => 'guest@test.com',
            'role' => 'guest',
            'password' => bcrypt('password123'),
        ]);

        // 2. Master Departemen (Sesuai Gambar Soal)
        $depts = [
            ['id' => 1, 'name' => 'Accounting'],
            ['id' => 2, 'name' => 'Business Development'],
            ['id' => 3, 'name' => 'Engineering'],
            ['id' => 4, 'name' => 'Human Resources'],
            ['id' => 5, 'name' => 'Legal'],
            ['id' => 6, 'name' => 'Marketing'],
            ['id' => 7, 'name' => 'Product Management'],
            ['id' => 8, 'name' => 'Sales'],
            ['id' => 9, 'name' => 'Training'],
        ];
        foreach ($depts as $d) MasterDepartemen::create($d);

        // 3. Master Lowongan (Sesuai PDF Hal 4)
        $jobs = [
            ['id' => 1, 'dept_id' => 1, 'posisi' => 'Staff Akuntansi', 'quota' => 12, 'deskripsi' => 'Mengelola jurnal harian dan closing bulanan.'],
            ['id' => 2, 'dept_id' => 2, 'posisi' => 'Business Dev Officer', 'quota' => 10, 'deskripsi' => 'Riset pasar & membuka peluang kemitraan baru.'],
            ['id' => 3, 'dept_id' => 3, 'posisi' => 'Software Engineer', 'quota' => 3, 'deskripsi' => 'Kembangkan fitur berbasis Laravel & ERP.'],
            ['id' => 4, 'dept_id' => 3, 'posisi' => 'QA/QC Engineer', 'quota' => 2, 'deskripsi' => 'Uji kualitas proses/produk & dokumentasi.'],
            ['id' => 5, 'dept_id' => 4, 'posisi' => 'HR Generalist', 'quota' => 8, 'deskripsi' => 'Rekrutmen, administrasi HR, dan employee relations.'],
            ['id' => 6, 'dept_id' => 5, 'posisi' => 'Legal Officer', 'quota' => 5, 'deskripsi' => 'Review kontrak, compliance, dan dokumentasi hukum.'],
            ['id' => 7, 'dept_id' => 8, 'posisi' => 'Account Executive', 'quota' => 10, 'deskripsi' => 'Prospek klien, presentasi solusi, dan capai target.'],
            ['id' => 8, 'dept_id' => 9, 'posisi' => 'Trainer Internal', 'quota' => 5, 'deskripsi' => 'Susun materi & melatih user terkait sistem.'],
        ];
        
        foreach ($jobs as $j) {
            MasterLowongan::create([
                ...$j, 
                'is_active' => true, 
                'user_create' => 'Seeder'
            ]);
        }

        
        $applicants = [
            [
                'lowongan_id' => 5, 
                'name' => 'John Doe',
                'gender' => 'male',
                'dob' => '2000-11-02',
                'address' => 'Sidoarjo',
                'no_telp' => '0878555682',
                'university' => 'Universitas Brawijaya',
                'major' => 'Teknik Informatika',
                'ipk' => '3.88',
                'path_cv' => 'dummy.pdf',
                'status' => 'P'  
            ],
            [
                'lowongan_id' => 1,  
                'name' => 'Kevin',
                'gender' => 'male',
                'dob' => '2000-10-10',
                'address' => 'Surabaya',
                'no_telp' => '0858555466',
                'university' => 'Universitas Negeri Surabaya',
                'major' => 'Manajemen Pemasaran',
                'ipk' => '3.5',
                'path_cv' => 'dummy.pdf',
                'status' => 'A'  
            ],
            [
                'lowongan_id' => 4,  
                'name' => 'Bob Marley',
                'gender' => 'male',
                'dob' => '2004-12-12',
                'address' => 'Surabaya',
                'no_telp' => '0854555518',
                'university' => 'Universitas Airlangga',
                'major' => 'Ilmu Komunikasi',
                'ipk' => '4.0',
                'path_cv' => 'dummy.pdf',
                'status' => 'R'  
            ]
        ];

        foreach ($applicants as $app) {
            TransaksiPendaftar::create($app);
        }

         
        $this->createDummy(1, 4, 'A');
        $this->createDummy(1, 2, 'R');

         
        $this->createDummy(2, 2, 'A');
        $this->createDummy(2, 2, 'R');

      
        $this->createDummy(3, 3, 'A');
        $this->createDummy(4, 1, 'R');  

         
        $this->createDummy(5, 7, 'A');
        $this->createDummy(5, 3, 'R');

         
        $this->createDummy(6, 1, 'A');
        $this->createDummy(6, 1, 'R');

         
        $this->createDummy(7, 2, 'A');
        $this->createDummy(7, 2, 'R');
 
        $this->createDummy(8, 3, 'A');
        $this->createDummy(8, 2, 'R');
    }

    
    private function createDummy($lowonganId, $count, $status) {
        for($i=0; $i<$count; $i++) {
            TransaksiPendaftar::create([
                'lowongan_id' => $lowonganId,
                'name' => 'Pelamar Dummy ' . rand(100, 999),
                'gender' => 'female',
                'dob' => '1995-05-20',
                'address' => 'Jakarta',
                'no_telp' => '08123456789',
                'university' => 'Univ Dummy',
                'major' => 'Umum',
                'ipk' => 3.50,
                'path_cv' => 'dummy.pdf',
                'status' => $status
            ]);
        }
    }
}