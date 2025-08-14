<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UjiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'rafi',
                'pekerjaan' => 'Karyawan Swasta',
                'penghasilan' => 2500000,
                'tabungan' => 300000,
                'pinjaman' => 500000,
                'status_pinjaman' => 'Lunas',
                'status_kelayakan' => null, // Akan dihitung oleh KNN
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'reka',
                'pekerjaan' => 'Petani',
                'penghasilan' => 1000000,
                'tabungan' => 100000,
                'pinjaman' => 700000,
                'status_pinjaman' => 'Menunggak',
                'status_kelayakan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'azis',
                'pekerjaan' => 'Pedagang',
                'penghasilan' => 1800000,
                'tabungan' => 200000,
                'pinjaman' => 0,
                'status_pinjaman' => 'Tidak Meminjam',
                'status_kelayakan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data lainnya jika perlu
        ];

        DB::table('uji')->insert($data);
    }
}
