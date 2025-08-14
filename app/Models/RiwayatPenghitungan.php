<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPenghitungan extends Model
{
    use HasFactory;

    protected $table = 'riwayatpenghitungan';

    protected $fillable = [
        'nama',
        'pekerjaan',
        'penghasilan',
        'status_pembayaran',
        'jumlah_pinjaman',
        'jumlah_tabungan',
        'hasil_klasifikasi',
        'jarak_terdekat',
    ];

     protected $casts = [
        'detail_hasil' => 'array'
    ];
    
    public function getKAttribute()
    {
        return $this->detail_hasil['k'] ?? null;
    }
    
    public function getKTerdekatAttribute()
    {
        return $this->detail_hasil['k_terdekat'] ?? [];
    }
}
