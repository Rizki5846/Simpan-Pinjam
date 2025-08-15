<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Latih extends Model
{
    protected $table = 'latih';
    protected $fillable = [
        'pekerjaan', 'penghasilan', 'status_pembayaran',
        'lama_keanggotaan', 'jumlah_pinjaman', 'jumlah_tabungan',
        'status_kelayakan', 'anggota_id'
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}