@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-project-diagram me-2"></i>Hasil Klasifikasi KNN
                </h4>
                <div>
                    <span class="badge bg-light text-dark">
                        K=5 (5 Tetangga Terdekat)
                    </span>
                <a href="{{ route('knn.riwayat') }}" class="btn btn-info">
                    <i class="fas fa-history me-1"></i> Lihat Riwayat
                </a>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">#</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ujiData as $item)
                        <tr>
                            <td>{{ $loop->iteration + ($ujiData->currentPage() - 1) * $ujiData->perPage() }}</td>
                            <td>{{ $item->pengajuan->nama }}</td>
                            <td>
                                <span class="badge bg-{{ $item->prediksi_kelayakan == 'Layak' ? 'success' : ($item->prediksi_kelayakan ? 'danger' : 'warning') }}">
                                    {{ $item->prediksi_kelayakan ?? 'Belum Diproses' }}
                                </span>
                            </td>
                           
                            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-center">
                                <a href="{{ route('knn.show', $item->id) }}" 
                                   class="btn btn-sm btn-info" 
                                   title="Detail">
                                    <i class="fas fa-eye">Show</i>
                                </a>
                                
                                @if(!$item->prediksi_kelayakan)
                                <a href="{{ route('knn.classify', $item->id) }}" 
                                   class="btn btn-sm btn-primary"
                                   title="Proses Klasifikasi">
                                    <i class="fas fa-calculator">Hasil</i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-between mt-3">
                <div>
                    <p class="text-muted mb-0">
                        Menampilkan {{ $ujiData->firstItem() }} - {{ $ujiData->lastItem() }} dari {{ $ujiData->total() }} hasil
                    </p>
                </div>
                <div>
                    {{ $ujiData->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection