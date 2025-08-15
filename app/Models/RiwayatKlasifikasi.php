<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatKlasifikasi extends Model
{
    use HasFactory;
    protected $table = 'riwayat_klasifikasi';
    protected $fillable = [
        'uji_id',
        'prediksi_kelayakan',
        'confidence',
        'neighbors'
    ];

    protected $casts = [
        'neighbors' => 'array'
    ];

    public function uji()
    {
        return $this->belongsTo(Uji::class);
    }

}
