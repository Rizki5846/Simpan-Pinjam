<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;

    protected $table = 'pinjaman'; // pastikan ini ditambahkan jika nama tidak plural

    protected $fillable = [
        'nama',
        'pekerjaan',
        'penghasilan',
        'tabungan',
        'pinjaman',
        'status_pinjaman',
        'user_id',
    ];

    public function riwayat()
    {
        return $this->hasMany(RiwayatPinjaman::class); 
    }

        public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'nama', 'nama');
    }

  
}
