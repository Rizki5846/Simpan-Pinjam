@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-success mb-4">Penghitungan KNN</h2>

    @if(session('error'))
        <div class="alert alert-danger mb-4">{{ session('error') }}</div>
    @endif
    <form method="POST" action="{{ route('PenghitunganKnn.hitung') }}">
    @csrf
    <div class="row g-3 mb-4">
        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-success shadow-sm">
                <i class="fas fa-calculator me-1"></i> Mulai Klasifikasi
            </button>
        </div>
    </div>
</form>

    @if(count($hasil) > 0)
        <div class="alert alert-info mb-4">
            Menggunakan nilai K = <strong>{{ $k }}</strong> dengan normalisasi Min-Max
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Hasil Klasifikasi</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-success">
                        <tr>
                            <th>Nama</th>
                            <th>Hasil</th>
                            <th>Jarak Terdekat</th>
                            <th>Detail Tetangga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hasil as $row)
                            <tr>
                                <td>{{ $row['nama'] }}</td>
                                <td>
                                    @if($row['hasil'] == 'Layak')
                                        <span class="badge bg-success">Layak</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Layak</span>
                                    @endif
                                </td>
                                <td>{{ number_format($row['jarak_terdekat'], 4) }}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-info" data-bs-toggle="collapse" data-bs-target="#detail-{{ $row['id'] }}">
                                        Lihat {{ $k }} Tetangga
                                    </button>
                                </td>
                            </tr>
                            <tr class="collapse" id="detail-{{ $row['id'] }}">
                                <td colspan="4" class="p-3 bg-light">
                                    <strong>Detail Tetangga Terdekat:</strong>
                                    <ul class="list-group mt-2">
                                        @foreach($row['k_terdekat'] as $i => $tetangga)
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>#{{ $i+1 }}</span>
                                                <span>Jarak: {{ number_format($tetangga['jarak'], 4) }}</span>
                                                <span>Status:
                                                    @if($tetangga['status_kelayakan'] == 'Layak')
                                                        <span class="badge bg-success">Layak</span>
                                                    @else
                                                        <span class="badge bg-danger">Tidak Layak</span>
                                                    @endif
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="alert alert-info">
            Belum ada hasil klasifikasi.
        </div>
    @endif
</div>
@endsection
