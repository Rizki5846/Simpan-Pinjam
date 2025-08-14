<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Latih extends Model
{
    use HasFactory;
    protected $table = 'latih';

   protected $fillable = [
    'nik', 'nama', 'pekerjaan', 'penghasilan',
    'jumlah_tabungan', 'jumlah_pinjaman',
    'status_pinjaman', 'status_kelayakan',
    'lama_keanggotaan_tahun', 'lama_keanggotaan_bulan'
];
}
