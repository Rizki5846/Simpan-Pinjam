<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

   protected $table = 'pengajuan';

    protected $fillable = [
        'nik',
        'nama',
        'pekerjaan',
        'penghasilan',
        'tabungan',
        'pinjaman',
        'status_pinjaman',
        'user_id',
        'anggota_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Kalau kamu punya tabel anggota terpisah
    public function riwayat()
    {
        return $this->hasMany(Pengajuan::class); // jika pengajuan = riwayat
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
    
    public function uji()
    {
        return $this->hasOne(Uji::class);
    }
}
