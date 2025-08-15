@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-history me-2"></i>Riwayat Klasifikasi
                </h4>
                <a href="{{ route('knn.index') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Hasil</th>
                            <th>Confidence</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riwayat as $item)
                        <tr class="{{ $item->prediksi_kelayakan == 'Layak' ? 'table-success' : 'table-danger' }}">
                            <td>{{ ($riwayat->currentPage() - 1) * $riwayat->perPage() + $loop->iteration }}</td>
                            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $item->uji->pengajuan->nama }}</td>
                            <td>{{ $item->prediksi_kelayakan }}</td>
                            <td>{{ number_format($item->confidence, 2) }}%</td>
                            <td>
                                <a href="{{ route('knn.show', $item->uji_id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $riwayat->links() }}
            </div>
        </div>
    </div>
</div>
@endsection