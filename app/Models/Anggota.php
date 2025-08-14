<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
use HasFactory;
    protected $table = 'anggota';
    protected $fillable = [
        'nik',
        'nama',
        'pekerjaan',
        'penghasilan',
        'status_pinjaman',
        'jumlah_pinjaman',
        'jumlah_tabungan',
        'status_kelayakan',
        'lama_keanggotaan_tahun',
        'lama_keanggotaan_bulan'
    ];

        public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class);
    }
}
