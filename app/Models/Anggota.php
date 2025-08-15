<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';
    protected $fillable = [
        'nik', 'nama', 'pekerjaan', 'penghasilan', 
        'jumlah_tabungan', 'jumlah_pinjaman',
        'status_pembayaran', 'lama_keanggotaan'
    ];

    public function latih()
    {
        return $this->hasOne(Latih::class);
    }

    // Konversi ke data latih
    public function convertToLatih($status_kelayakan)
    {
        return [
            'pekerjaan'         => $this->convertPekerjaan($this->pekerjaan),
            'penghasilan'       => $this->normalizeMinMax('penghasilan'),
            'status_pembayaran' => $this->convertStatus($this->status_pembayaran),
            'lama_keanggotaan'  => $this->convertLama($this->lama_keanggotaan),
            'jumlah_pinjaman'   => $this->normalizeMinMax('jumlah_pinjaman'),
            'jumlah_tabungan'   => $this->normalizeMinMax('jumlah_tabungan'),
            'status_kelayakan'  => $status_kelayakan,
            'anggota_id'        => $this->id
        ];
    }

    private function convertPekerjaan($value)
    {
        return match($value) {
            'PNS' => 1.0,
            'Swasta' => 0.5,
            'Wirausaha' => 0.0
        };
    }

    private function convertStatus($value)
    {
        return match($value) {
            'Lancar' => 0.0,
            'Belum Pernah' => 0.5,
            'Menunggak' => 1.0
        };
    }

    private function convertLama($value)
    {
        return match($value) {
            '<1 Tahun' => 0.0,
            '1-2 Tahun' => 0.5,
            '>2 Tahun' => 1.0
        };
    }

    // Min-Max Normalization
    private function normalizeMinMax($column)
    {
        $min = self::min($column);
        $max = self::max($column);

        if ($max == $min) {
            return 0; // semua nilai sama → normalisasi jadi 0
        }

        return ($this->$column - $min) / ($max - $min);
    }
}
