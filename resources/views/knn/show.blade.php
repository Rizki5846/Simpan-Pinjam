@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-{{ $dataUji->prediksi_kelayakan == 'Layak' ? 'success' : ($dataUji->prediksi_kelayakan ? 'danger' : 'primary') }} text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>Detail Klasifikasi
                </h4>
                <a href="{{ route('knn.pdf', $dataUji->id) }}" class="btn btn-danger" target="_blank">
                    <i class="fas fa-file-pdf"></i> Cetak PDF
                </a>
                <a href="{{ route('knn.index') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
        
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            <h5>Data Pengajuan</h5>
            <div class="row mb-4">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Nama</th>
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
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Jumlah Pinjaman</th>
                            <td>Rp {{ number_format($dataUji->pengajuan->jumlah_pinjaman, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Status Pembayaran</th>
                            <td>{{ $dataUji->pengajuan->status_pembayaran }}</td>
                        </tr>
                        <tr>
                            <th>Lama Keanggotaan</th>
                            <td>{{ $dataUji->pengajuan->lama_keanggotaan }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            @if($dataUji->prediksi_kelayakan)
            <div class="alert alert-{{ $dataUji->prediksi_kelayakan == 'Layak' ? 'success' : 'danger' }}">
                <h4 class="alert-heading">
                    Hasil Prediksi: {{ $dataUji->prediksi_kelayakan }}
                </h4>
                <p class="mb-0">
                    Tingkat Keyakinan: {{ number_format($dataUji->confidence, 2) }}%
                </p>
            </div>
            
            <h5 class="mt-4">5 Tetangga Terdekat</h5>
            @if(empty($neighbors))
                <div class="alert alert-warning">
                    Data tetangga terdekat tidak tersedia.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($neighbors as $index => $neighbor)
                            <tr class="{{ $neighbor['class'] == 'Layak' ? 'table-success' : 'table-danger' }}">
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
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" 
                                        data-bs-target="#detailModal{{ $index }}">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            @else
            <div class="alert alert-warning">
                <h4 class="alert-heading">Belum Diproses</h4>
                <p class="mb-0">Data ini belum melalui proses klasifikasi.</p>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('knn.classify', $dataUji->id) }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-calculator me-2"></i> Jalankan Klasifikasi
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

@if(!empty($neighbors))
<!-- Modal for neighbor details -->
@foreach($neighbors as $index => $neighbor)
<div class="modal fade" id="detailModal{{ $index }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Data Latih #{{ $neighbor['id'] }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr>
                                <th width="40%">Pekerjaan</th>
                                <td>{{ $neighbor['details']['pekerjaan_label'] }} ({{ $neighbor['features']['pekerjaan'] }})</td>
                            </tr>
                            <tr>
                                <th>Penghasilan</th>
                                <td>
                                    Rp {{ number_format($neighbor['details']['penghasilan_denormalized'], 0, ',', '.') }}<br>
                                    <small>Normalized: {{ number_format($neighbor['features']['penghasilan'], 2) }}</small>
                                </td>
                            </tr>
                            <tr>
                                <th>Status Pembayaran</th>
                                <td>
                                    {{ $neighbor['details']['status_pembayaran_label'] }}<br>
                                    <small>Kode: {{ $neighbor['features']['status_pembayaran'] }}</small>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr>
                                <th width="40%">Lama Keanggotaan</th>
                                <td>
                                    {{ $neighbor['details']['lama_keanggotaan_label'] }}<br>
                                    <small>Kode: {{ $neighbor['features']['lama_keanggotaan'] }}</small>
                                </td>
                            </tr>
                            <tr>
                                <th>Jumlah Pinjaman</th>
                                <td>
                                    Rp {{ number_format($neighbor['details']['jumlah_pinjaman_denormalized'], 0, ',', '.') }}<br>
                                    <small>Normalized: {{ number_format($neighbor['features']['jumlah_pinjaman'], 2) }}</small>
                                </td>
                            </tr>
                            <tr>
                                <th>Jumlah Tabungan</th>
                                <td>
                                    Rp {{ number_format($neighbor['details']['jumlah_tabungan_denormalized'], 0, ',', '.') }}<br>
                                    <small>Normalized: {{ number_format($neighbor['features']['jumlah_tabungan'], 2) }}</small>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="alert alert-info">
                        <strong>Jarak Euclidean:</strong> {{ number_format($neighbor['distance'], 4) }}<br>
                        <strong>Status Kelayakan:</strong> {{ $neighbor['class'] }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif

<style>
    .table-responsive {
        overflow-x: auto;
    }
    .table th {
        white-space: nowrap;
        font-size: 0.85rem;
        background-color: #f8f9fa;
    }
    .table td {
        font-size: 0.85rem;
        vertical-align: middle;
    }
    .table-sm th, .table-sm td {
        padding: 0.5rem;
    }
    .table-success {
        background-color: rgba(25, 135, 84, 0.1);
    }
    .table-danger {
        background-color: rgba(220, 53, 69, 0.1);
    }
    .modal-body small {
        color: #6c757d;
        font-size: 0.8rem;
    }
</style>
@endsection