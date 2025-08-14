<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LatihSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nik' => '1234567890123456',
                'nama' => 'Ahmad',
                'pekerjaan' => 'Petani',
                'penghasilan' => 2000000,
                'tabungan' => 500000,
                'pinjaman' => 0,
                'status_pinjaman' => 'Tidak Meminjam',
                'status_kelayakan' => 'Layak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '2345678901234567',
                'nama' => 'Budi',
                'pekerjaan' => 'Buruh',
                'penghasilan' => 1200000,
                'tabungan' => 100000,
                'pinjaman' => 300000,
                'status_pinjaman' => 'Belum Lunas',
                'status_kelayakan' => 'Tidak Layak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '3456789012345678',
                'nama' => 'Citra',
                'pekerjaan' => 'Guru',
                'penghasilan' => 3500000,
                'tabungan' => 1000000,
                'pinjaman' => 0,
                'status_pinjaman' => 'Tidak Meminjam',
                'status_kelayakan' => 'Layak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data lainnya sesuai kebutuhan
        ];

        DB::table('latih')->insert($data);
    }
}
