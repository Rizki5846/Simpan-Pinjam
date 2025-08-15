<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Uji extends Model
{
	use HasFactory;

	protected $table = 'data_uji';
    protected $fillable = [
        'pekerjaan', 'penghasilan', 'status_pembayaran',
        'lama_keanggotaan', 'jumlah_pinjaman', 'jumlah_tabungan',
        'prediksi_kelayakan', 'pengajuan_id'
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

		public function anggota()
		{
			return $this->belongsTo(Anggota::class);
		}

		public function user()
		{
			return $this->belongsTo(User::class);
		}
	public function riwayat()
    {
        return $this->hasMany(RiwayatKlasifikasi::class);
    }
	protected $casts = [
    'neighbors' => 'array'
];

}
