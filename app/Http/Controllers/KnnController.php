<?php

namespace App\Http\Controllers;

use App\Models\Latih;
use App\Models\RiwayatKlasifikasi;
use App\Models\Uji;
use App\Services\KNNService;
use Illuminate\Http\Request;

class KnnController extends Controller
{
    public function index()
    {
        $ujiData = Uji::with('pengajuan')
                  ->orderBy('created_at', 'desc')
                  ->paginate(10);
        
        return view('knn.index', compact('ujiData'));
    }

public function show($id)
{
    $dataUji = Uji::with(['pengajuan', 'riwayat' => function($query) {
        $query->latest()->limit(1); // Ambil hanya 1 record terbaru
    }])->findOrFail($id);

    $neighbors = $dataUji->neighbors 
                ?? optional($dataUji->riwayat->first())->neighbors
                ?? [];

    return view('knn.show', compact('dataUji', 'neighbors'));
}
    public function classify($id)
    {
        $dataUji = Uji::findOrFail($id);
        $knn = new KNNService(5); // Using K=5
        
        $result = $knn->predict($dataUji);
        
        // Update prediction result
        $dataUji->update([
            'prediksi_kelayakan' => $result['prediction'],
            'confidence' => $result['confidence']
        ]);
        
        // Simpan ke riwayat
        RiwayatKlasifikasi::create([
            'uji_id' => $dataUji->id,
            'prediksi_kelayakan' => $result['prediction'],
            'confidence' => $result['confidence'],
            'neighbors' => $result['neighbors']
        ]);
        
        return redirect()->route('knn.show', $dataUji->id)
            ->with([
                'success' => 'Klasifikasi berhasil dilakukan',
                'neighbors' => $result['neighbors']
            ]);
    }

    public function riwayat()
    {
        $riwayat = RiwayatKlasifikasi::with('uji.pengajuan')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        
        return view('knn.riwayat', compact('riwayat'));
    }
}