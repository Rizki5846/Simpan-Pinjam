<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Uji extends Model
{
	use HasFactory;

	protected $table = 'uji';

	protected $fillable = ['nik','nama', 'pekerjaan', 'penghasilan', 'tabungan', 'pinjaman', 'status_pinjaman','status_persetujuan','catatan','anggota_id','pengajuan_id'];
	

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

}
