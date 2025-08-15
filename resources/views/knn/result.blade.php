<!-- resources/views/klasifikasi/result.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-{{ $dataUji->prediksi_kelayakan == 'Layak' ? 'success' : 'danger' }} text-white">
            <h4 class="mb-0">
                <i class="fas fa-poll me-2"></i>Hasil Klasifikasi
            </h4>
        </div>
        <div class="card-body">
            <div class="alert alert-{{ $dataUji->prediksi_kelayakan == 'Layak' ? 'success' : 'danger' }}">
                <h4 class="alert-heading">
                    Hasil Prediksi: {{ $dataUji->prediksi_kelayakan }}
                </h4>
                <p class="mb-0">
                    Tingkat Keyakinan: {{ number_format($confidence, 2) }}%
                    ({{ array_count_values(array_column($nearestNeighbors, 'class'))[$dataUji->prediksi_kelayakan] }}
                    dari 5 tetangga terdekat)
                </p>
            </div>

            <h5 class="mt-4">5 Tetangga Terdekat</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>ID Data Latih</th>
                            <th>Jarak</th>
                            <th>Kelas</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nearestNeighbors as $neighbor)
                        <tr class="{{ $neighbor['class'] == 'Layak' ? 'table-success' : 'table-danger' }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $neighbor['id'] }}</td>
                            <td>{{ number_format($neighbor['distance'], 4) }}</td>
                            <td>{{ $neighbor['class'] }}</td>
                            <td>
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" 
                                    data-bs-target="#detailModal{{ $loop->index }}">
                                    <i class="fas fa-eye"></i> Lihat
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <a href="{{ route('pengajuan.show', $dataUji->pengajuan_id) }}" class="btn btn-secondary mt-3">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Detail Pengajuan
            </a>
        </div>
    </div>
</div>

<!-- Modal for neighbor details -->
@foreach($nearestNeighbors as $index => $neighbor)
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
                                <th>Pekerjaan</th>
                                <td>{{ $neighbor['details']['pekerjaan'] }}</td>
                            </tr>
                            <tr>
                                <th>Penghasilan</th>
                                <td>Rp {{ number_format($neighbor['details']['penghasilan'], 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Status Pembayaran</th>
                                <td>{{ $neighbor['details']['status_pembayaran'] }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr>
                                <th>Lama Keanggotaan</th>
                                <td>{{ $neighbor['details']['lama_keanggotaan'] }}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Pinjaman</th>
                                <td>Rp {{ number_format($neighbor['details']['jumlah_pinjaman'], 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Tabungan</th>
                                <td>Rp {{ number_format($neighbor['details']['jumlah_tabungan'], 0, ',', '.') }}</td>
                            </tr>
                        </table>
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
@endsection