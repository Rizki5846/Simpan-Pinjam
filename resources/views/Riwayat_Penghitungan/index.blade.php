@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Riwayat Penghitungan KNN</h3>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($riwayat->isEmpty())
        <div class="alert alert-info">
            Belum ada riwayat penghitungan.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped shadow-sm">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Hasil Prediksi</th>
                        <th>Jarak Terdekat</th>
                        <th>K</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayat as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>
                            @if($item->hasil_klasifikasi == 'Layak')
                                <span class="badge bg-success">Layak</span>
                            @else
                                <span class="badge bg-danger">Tidak Layak</span>
                            @endif
                        </td>
                        <td>{{ number_format($item->jarak_terdekat, 4) }}</td>
                        <td>{{ $item->k }}</td>
                        <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            @if(!empty($item->k_terdekat))
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" 
                                        data-bs-target="#detailModal{{ $item->id }}">
                                    <i class="fas fa-info-circle"></i> Detail
                                </button>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<!-- Modal untuk detail tetangga -->
@foreach($riwayat as $item)
@if(!empty($item->k_terdekat))
<div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Detail Tetangga Terdekat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h6>Data Utama:</h6>
                <ul class="list-group mb-4">
                    <li class="list-group-item"><strong>Nama:</strong> {{ $item->nama }}</li>
                    <li class="list-group-item"><strong>Hasil:</strong> 
                        @if($item->hasil_klasifikasi == 'Layak')
                            <span class="badge bg-success">Layak</span>
                        @else
                            <span class="badge bg-danger">Tidak Layak</span>
                        @endif
                    </li>
                    <li class="list-group-item"><strong>K:</strong> {{ $item->k }}</li>
                    <li class="list-group-item"><strong>Jarak Terdekat:</strong> {{ number_format($item->jarak_terdekat, 4) }}</li>
                </ul>
                
                <h6>Tetangga Terdekat:</h6>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Jarak</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item->k_terdekat as $idx => $tetangga)
                            <tr>
                                <td>{{ $idx + 1 }}</td>
                                <td>{{ number_format($tetangga['jarak'], 4) }}</td>
                                <td>
                                    @if($tetangga['status_kelayakan'] == 'Layak')
                                        <span class="badge bg-success">Layak</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Layak</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach
@endsection