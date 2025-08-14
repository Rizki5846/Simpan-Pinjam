<?php

namespace App\Imports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnggotaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Anggota([
            'nik' => $row['nik'],
            'nama' => $row['nama'],
            'pekerjaan' => $row['pekerjaan'],
            'penghasilan' => $row['penghasilan'],
            'status_pembayaran' => $row['status_pembayaran'],
            'keanggotaan_koperasi' => $row['keanggotaan_koperasi'],
            'jumlah_pinjaman' => $row['jumlah_pinjaman'],
            'jumlah_tabungan' => $row['jumlah_tabungan'],
            'status_kelayakan' => $row['status_kelayakan'] ?? null,
        ]);
    }
}
