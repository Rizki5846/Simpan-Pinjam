<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anggota;

class AnggotaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nik' => '1234567890123456',
                'nama' => 'Andi',
                'pekerjaan' => 'PNS',
                'penghasilan' => 5000000,
                'jumlah_tabungan' => 10000000,
                'jumlah_pinjaman' => 2000000,
                'status_pembayaran' => 'Lancar',
                'lama_keanggotaan' => '<1 Tahun'
            ],
            [
                'nik' => '1234567890123457',
                'nama' => 'Budi',
                'pekerjaan' => 'Swasta',
                'penghasilan' => 3000000,
                'jumlah_tabungan' => 5000000,
                'jumlah_pinjaman' => 4000000,
                'status_pembayaran' => 'Menunggak',
                'lama_keanggotaan' => '1-2 Tahun'
            ],
            [
                'nik' => '1234567890123458',
                'nama' => 'Citra',
                'pekerjaan' => 'Wirausaha',
                'penghasilan' => 7000000,
                'jumlah_tabungan' => 15000000,
                'jumlah_pinjaman' => 1000000,
                'status_pembayaran' => 'Belum Pernah',
                'lama_keanggotaan' => '>2 Tahun'
            ],
            [
                'nik' => '1234567890123459',
                'nama' => 'Deni',
                'pekerjaan' => 'PNS',
                'penghasilan' => 6000000,
                'jumlah_tabungan' => 8000000,
                'jumlah_pinjaman' => 3000000,
                'status_pembayaran' => 'Lancar',
                'lama_keanggotaan' => '1-2 Tahun'
            ],
        ];

        foreach ($data as $item) {
            Anggota::create($item);
        }
    }
}
