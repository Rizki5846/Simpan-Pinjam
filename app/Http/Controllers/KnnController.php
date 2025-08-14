<?php

namespace App\Http\Controllers;

use App\Models\Latih;
use App\Models\Uji;
use Illuminate\Http\Request;

class KnnController extends Controller
{
    public function index()
    {
        $ujiData = Uji::where('status_persetujuan', 'sedang proses')->get();
        return view('knn.index', compact('ujiData'));
    }

   public function classify(Request $request, $id)
    {
        $uji = Uji::findOrFail($id);
        $latihData = Latih::all();
        
        $distances = [];
        foreach ($latihData as $latih) {
            $distance = $this->calculateDistance($uji, $latih);
            $distances[] = [
                'data' => $latih,
                'distance' => $distance,
                'status_kelayakan' => $latih->status_kelayakan ?? '-'
            ];
        }
        
        usort($distances, function ($a, $b) {
            return $a['distance'] <=> $b['distance'];
        });
        
        $k = 5;
        $nearestNeighbors = array_slice($distances, 0, $k);
        
        // Inisialisasi dengan semua kemungkinan status
        $frequency = [
            'Layak' => 0,
            'Tidak Layak' => 0,
            '-' => 0
        ];
        
        foreach ($nearestNeighbors as $neighbor) {
            $status = $neighbor['status_kelayakan'];
            if (array_key_exists($status, $frequency)) {
                $frequency[$status]++;
            } else {
                // Log unexpected status if needed
                $frequency['-']++;
            }
        }
        
        arsort($frequency);
        $predictedStatus = key($frequency);
        
        return view('knn.result', [
            'uji' => $uji,
            'nearestNeighbors' => $nearestNeighbors,
            'predictedStatus' => $predictedStatus,
            'frequency' => $frequency
        ]);
    }
    
    private function calculateDistance($uji, $latih)
    {
        // Normalisasi data sebelum menghitung jarak
        $maxPenghasilan = Latih::max('penghasilan');
        $maxTabungan = Latih::max('jumlah_tabungan');
        $maxPinjaman = Latih::max('jumlah_pinjaman');
        
        // Hitung jarak Euclidean dengan normalisasi
        $penghasilanDiff = ($uji->penghasilan - $latih->penghasilan) / $maxPenghasilan;
        $tabunganDiff = ($uji->tabungan - $latih->jumlah_tabungan) / $maxTabungan;
        $pinjamanDiff = ($uji->pinjaman - $latih->jumlah_pinjaman) / $maxPinjaman;
        
        return sqrt(
            pow($penghasilanDiff, 2) + 
            pow($tabunganDiff, 2) + 
            pow($pinjamanDiff, 2)
        );
    }
    
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_persetujuan' => 'required|in:diterima,ditolak',
            'catatan' => 'nullable|string'
        ]);
        
        $uji = Uji::findOrFail($id);
        $uji->update([
            'status_persetujuan' => $request->status_persetujuan,
            'catatan' => $request->catatan,
            'status_kelayakan' => $request->status_persetujuan == 'diterima' ? 'Layak' : 'Tidak Layak'
        ]);
        
        return redirect()->route('knn.index')->with('success', 'Status pengajuan berhasil diperbarui');
    }
}