<?php

namespace App\Imports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AnggotaImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Anggota([
            'nik' => $row['nik'],
            'nama' => $row['nama'],
            'pekerjaan' => $row['pekerjaan'],
            'penghasilan' => $row['penghasilan'],
            'jumlah_tabungan' => $row['jumlah_tabungan'],
            'jumlah_pinjaman' => $row['jumlah_pinjaman'],
            'status_pembayaran' => $row['status_pembayaran'],
            'lama_keanggotaan' => $row['lama_keanggotaan'],
        ]);
    }

    public function rules(): array
    {
        return [
            'nik' => 'required|digits:16|unique:anggota,nik',
            'nama' => 'required',
            'pekerjaan' => 'required|in:PNS,Swasta,Wirausaha',
            'penghasilan' => 'required|numeric|min:0',
            'jumlah_tabungan' => 'required|numeric|min:0',
            'jumlah_pinjaman' => 'required|numeric|min:0',
            'status_pembayaran' => 'required|in:Lancar,Menunggak,Belum Pernah',
            'lama_keanggotaan' => 'required|in:<1 Tahun,1-2 Tahun,>2 Tahun'
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nik.digits' => 'NIK harus terdiri dari 16 digit angka',
            'nik.unique' => 'NIK :input sudah terdaftar',
            'pekerjaan.in' => 'Pekerjaan harus PNS, Swasta, atau Wirausaha',
            'status_pembayaran.in' => 'Status pembayaran harus Lancar, Menunggak, atau Belum Pernah',
            'lama_keanggotaan.in' => 'Lama keanggotaan harus <1 Tahun, 1-2 Tahun, atau >2 Tahun'
        ];
    }
}