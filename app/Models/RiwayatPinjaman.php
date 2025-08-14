<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPinjaman extends Model
{
    use HasFactory;

    protected $table = 'riwayat_pinjaman';
    protected $guarded = [];

    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class);
    }
}