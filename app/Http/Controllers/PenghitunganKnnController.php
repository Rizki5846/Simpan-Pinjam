<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPenghitungan;
use Illuminate\Http\Request;
use App\Models\Uji;
use Illuminate\Support\Facades\DB;

class PenghitunganKnnController extends Controller
{
    public function index()
    {
        // Pertama kali masuk ke halaman, belum dihitung
        return view('penghitunganKnn.index', [
            'hasil' => [],
            'k' => 5
        ]);
    }

    public function hitung(Request $request)
    {
        $k = $request->input('k', 5);
        $dataUji = Uji::all();
        $dataLatih = DB::table('latih')->get();

        if ($dataUji->isEmpty() || $dataLatih->isEmpty()) {
            return redirect()->route('PenghitunganKnn.index')
                ->with('error', 'Data uji atau data latih tidak ditemukan!');
        }

        $minMax = $this->hitungMinMax($dataLatih);
        $dataLatihNormalized = $this->normalisasiData($dataLatih, $minMax);
        $dataUjiNormalized = $this->normalisasiData($dataUji, $minMax);

        $hasilKlasifikasi = $this->hitungKnn($dataUjiNormalized, $dataLatihNormalized, $k);

        foreach ($dataUji as $index => $uji) {
            $hasil = $hasilKlasifikasi[$index];

            RiwayatPenghitungan::create([
                'nama' => $uji->nama,
                'pekerjaan' => $uji->pekerjaan,
                'penghasilan' => $uji->penghasilan,
                'status_pembayaran' => $uji->status_pinjaman,
                'jumlah_pinjaman' => $uji->pinjaman,
                'jumlah_tabungan' => $uji->tabungan,
                'hasil_klasifikasi' => $hasil['hasil'],
                'jarak_terdekat' => $hasil['jarak_terdekat'],
                'detail_hasil' => json_encode([
                    'k_terdekat' => $hasil['k_terdekat'],
                    'k' => $k
                ])
            ]);
        }

        return view('penghitunganKnn.index', [
            'hasil' => $hasilKlasifikasi,
            'k' => $k
        ]);
    }

    private function hitungMinMax($data)
    {
        return [
            'penghasilan' => ['min' => $data->min('penghasilan'), 'max' => $data->max('penghasilan')],
            'tabungan' => ['min' => $data->min('tabungan'), 'max' => $data->max('tabungan')],
            'pinjaman' => ['min' => $data->min('pinjaman'), 'max' => $data->max('pinjaman')]
        ];
    }

    private function normalisasiData($data, $minMax)
    {
        return $data->map(function($item) use ($minMax) {
            return (object) [
                'id' => $item->id,
                'nama' => $item->nama,
                'penghasilan' => $this->normalize($item->penghasilan, $minMax['penghasilan']['min'], $minMax['penghasilan']['max']),
                'tabungan' => $this->normalize($item->tabungan, $minMax['tabungan']['min'], $minMax['tabungan']['max']),
                'pinjaman' => $this->normalize($item->pinjaman, $minMax['pinjaman']['min'], $minMax['pinjaman']['max']),
                'status_kelayakan' => $item->status_kelayakan ?? null
            ];
        });
    }

    private function normalize($value, $min, $max)
    {
        return ($max - $min == 0) ? 0.5 : ($value - $min) / ($max - $min);
    }

    private function hitungKnn($dataUji, $dataLatih, $k)
    {
        $hasilKlasifikasi = [];

        foreach ($dataUji as $uji) {
            $jarakSemua = [];

            foreach ($dataLatih as $latih) {
                $jarak = sqrt(
                    pow($uji->penghasilan - $latih->penghasilan, 2) +
                    pow($uji->tabungan - $latih->tabungan, 2) +
                    pow($uji->pinjaman - $latih->pinjaman, 2)
                );

                $jarakSemua[] = [
                    'jarak' => $jarak,
                    'status_kelayakan' => $latih->status_kelayakan
                ];
            }

            usort($jarakSemua, fn($a, $b) => $a['jarak'] <=> $b['jarak']);
            $kTerdekat = array_slice($jarakSemua, 0, $k);
            $vote = array_count_values(array_column($kTerdekat, 'status_kelayakan'));
            arsort($vote);
            $hasil = array_key_first($vote);

            $hasilKlasifikasi[] = [
                'id' => $uji->id,
                'nama' => $uji->nama,
                'hasil' => $hasil,
                'jarak_terdekat' => $kTerdekat[0]['jarak'],
                'k_terdekat' => $kTerdekat
            ];

            Uji::find($uji->id)->update(['status_kelayakan' => $hasil]);
        }

        return $hasilKlasifikasi;
    }
}
