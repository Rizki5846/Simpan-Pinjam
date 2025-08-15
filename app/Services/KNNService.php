<?php

namespace App\Services;

use App\Models\Latih;
use App\Models\Uji;

class KNNService
{
    private $k;
    private $trainingData;
    private $testData;
    private $normalizationRanges;

    public function __construct($k = 5)
    {
        $this->k = $k;
        $this->trainingData = Latih::all();
        $this->setNormalizationRanges();
    }

    public function predict(Uji $testData)
    {
        $this->testData = $testData;
        
        $distances = $this->calculateDistances();
        
        usort($distances, function ($a, $b) {
            return $a['distance'] <=> $b['distance'];
        });
        
        $nearestNeighbors = array_slice($distances, 0, $this->k);
        
        $classCounts = array_count_values(
            array_column($nearestNeighbors, 'class')
        );
        
        arsort($classCounts);
        
       return [
        'prediction' => key($classCounts),
        'neighbors' => array_map(function ($neighbor) {
            return [
                'id' => $neighbor['id'],
                'distance' => $neighbor['distance'],
                'class' => $neighbor['class'],
                'features' => [
                    'pekerjaan' => $neighbor['details']['pekerjaan'],
                    'penghasilan' => $neighbor['details']['penghasilan'],
                    'status_pembayaran' => $neighbor['details']['status_pembayaran'],
                    'lama_keanggotaan' => $neighbor['details']['lama_keanggotaan'],
                    'jumlah_pinjaman' => $neighbor['details']['jumlah_pinjaman'],
                    'jumlah_tabungan' => $neighbor['details']['jumlah_tabungan'],
                ],
                'details' => $neighbor['details'] // Untuk modal detail
            ];
        }, $nearestNeighbors),
        'confidence' => reset($classCounts) / $this->k * 100
    ];
    }

    private function calculateDistances()
    {
        $distances = [];
        
        foreach ($this->trainingData as $training) {
            $distances[] = [
                'id' => $training->id,
                'distance' => $this->euclideanDistance($training),
                'class' => $training->status_kelayakan,
                'details' => $this->getDataDetails($training)
            ];
        }
        
        return $distances;
    }

    private function euclideanDistance($training)
    {
        $features = [
            'pekerjaan', 
            'penghasilan',
            'status_pembayaran',
            'lama_keanggotaan',
            'jumlah_pinjaman',
            'jumlah_tabungan'
        ];
        
        $sum = 0;
        
        foreach ($features as $feature) {
            $sum += pow($training->$feature - $this->testData->$feature, 2);
        }
        
        return sqrt($sum);
    }

    private function setNormalizationRanges()
    {
        $this->normalizationRanges = [
            'penghasilan' => ['min' => 800000, 'max' => 6000000],
            'jumlah_tabungan' => ['min' => 150000, 'max' => 5000000],
            'jumlah_pinjaman' => ['min' => 500000, 'max' => 5000000]
        ];
    }

    private function getDataDetails($training)
{
    return [
        'pekerjaan' => $training->pekerjaan,
        'pekerjaan_label' => $this->getPekerjaanLabel($training->pekerjaan),
        'penghasilan' => $training->penghasilan,
        'penghasilan_denormalized' => $this->denormalize('penghasilan', $training->penghasilan),
        'status_pembayaran' => $training->status_pembayaran,
        'status_pembayaran_label' => $this->getStatusLabel($training->status_pembayaran),
        'lama_keanggotaan' => $training->lama_keanggotaan,
        'lama_keanggotaan_label' => $this->getLamaKeanggotaanLabel($training->lama_keanggotaan),
        'jumlah_pinjaman' => $training->jumlah_pinjaman,
        'jumlah_pinjaman_denormalized' => $this->denormalize('jumlah_pinjaman', $training->jumlah_pinjaman),
        'jumlah_tabungan' => $training->jumlah_tabungan,
        'jumlah_tabungan_denormalized' => $this->denormalize('jumlah_tabungan', $training->jumlah_tabungan),
        'class' => $training->status_kelayakan
    ];
}

    private function denormalize($feature, $normalizedValue)
    {
        if (!isset($this->normalizationRanges[$feature])) {
            return $normalizedValue;
        }
        
        $min = $this->normalizationRanges[$feature]['min'];
        $max = $this->normalizationRanges[$feature]['max'];
        
        return round($normalizedValue * ($max - $min) + $min);
    }

    private function getPekerjaanLabel($value)
    {
        return match($value) {
            1.0 => 'PNS',
            0.5 => 'Swasta',
            0.0 => 'Wirausaha',
            default => 'Tidak Diketahui'
        };
    }

    private function getStatusLabel($value)
    {
        return match($value) {
            0.0 => 'Lancar',
            0.5 => 'Belum Pernah',
            1.0 => 'Menunggak',
            default => 'Tidak Diketahui'
        };
    }

    private function getLamaKeanggotaanLabel($value)
    {
        return match($value) {
            0.0 => '<1 Tahun',
            0.5 => '1-2 Tahun',
            1.0 => '>2 Tahun',
            default => 'Tidak Diketahui'
        };
    }
}