<!DOCTYPE html>
<html>
<head>
    <title>Hasil Klasifikasi</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin-bottom: 5px; }
        .header p { margin-top: 0; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .result-box { 
            padding: 10px; 
            margin-bottom: 20px;
            border-radius: 5px;
            color: white;
        }
        .layak { background-color: #28a745; }
        .tidak-layak { background-color: #dc3545; }
        .neighbors-table { font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Hasil Klasifikasi KNN</h2>
        <p>Tanggal: {{ date('d/m/Y H:i') }}</p>
    </div>

    <h3>Data Pengajuan</h3>
    <table>
        <tr>
            <th width="30%">Nama</th>
            <td>{{ $dataUji->pengajuan->nama }}</td>
        </tr>
        <tr>
            <th>Pekerjaan</th>
            <td>{{ $dataUji->pengajuan->pekerjaan }}</td>
        </tr>
        <tr>
            <th>Penghasilan</th>
            <td>Rp {{ number_format($dataUji->pengajuan->penghasilan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Jumlah Pinjaman</th>
            <td>Rp {{ number_format($dataUji->pengajuan->jumlah_pinjaman, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="result-box {{ $dataUji->prediksi_kelayakan == 'Layak' ? 'layak' : 'tidak-layak' }}">
        <h3>Hasil Prediksi: {{ $dataUji->prediksi_kelayakan }}</h3>
        <p>Tingkat Keyakinan: {{ number_format($dataUji->confidence, 2) }}%</p>
    </div>

    @if(!empty($neighbors))
    <h3>5 Tetangga Terdekat</h3>
    <table class="neighbors-table">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Data</th>
                <th>Jarak</th>
                <th>Pekerjaan</th>
                <th>Penghasilan</th>
                <th>Status Bayar</th>
                <th>Keanggotaan</th>
                <th>Jml Pinjaman</th>
                <th>Jml Tabungan</th>
                <th>Kelayakan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($neighbors as $neighbor)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $neighbor['id'] }}</td>
                <td>{{ number_format($neighbor['distance'], 4) }}</td>
                <td>{{ $neighbor['features']['pekerjaan'] }}</td>
                <td>{{ number_format($neighbor['features']['penghasilan'], 2) }}</td>
                <td>{{ $neighbor['features']['status_pembayaran'] }}</td>
                <td>{{ $neighbor['features']['lama_keanggotaan'] }}</td>
                <td>{{ number_format($neighbor['features']['jumlah_pinjaman'], 2) }}</td>
                <td>{{ number_format($neighbor['features']['jumlah_tabungan'], 2) }}</td>
                <td>{{ $neighbor['class'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</body>
</html>