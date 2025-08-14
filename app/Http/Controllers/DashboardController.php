<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Latih;
use App\Models\Uji;
use App\Models\Pengajuan;
use App\Models\RiwayatPenghitungan;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
       $jumlah_latih = Latih::count();
        $jumlah_uji = Uji::count();
        $jumlah_riwayat = RiwayatPenghitungan::count();
        
        // Data untuk grafik distribusi hasil
        $distribusiHasil = RiwayatPenghitungan::select('hasil_klasifikasi', DB::raw('count(*) as total'))
            ->groupBy('hasil_klasifikasi')
            ->get()
            ->pluck('total', 'hasil_klasifikasi');
            
        // Data untuk grafik per K
        $perhitunganPerK = RiwayatPenghitungan::select(DB::raw("JSON_EXTRACT(detail_hasil, '$.k') as k_value"), DB::raw('count(*) as total'))
            ->groupBy('k_value')
            ->get()
            ->map(function($item) {
                return [
                    'k' => $item->k_value,
                    'total' => $item->total
                ];
            });
            
        // Data untuk grafik tren waktu
        $trenWaktu = RiwayatPenghitungan::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as total')
            )
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('dashboard', compact(
            'jumlah_latih',
            'jumlah_uji',
            'jumlah_riwayat',
            'distribusiHasil',
            'perhitunganPerK',
            'trenWaktu'
        ));
    }
    
}


