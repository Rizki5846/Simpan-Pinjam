@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Hasil Klasifikasi KNN</h2>
    
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5>Data yang Diklasifikasi</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th>NIK</th>
                            <td>{{ $uji->nik }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $uji->nama }}</td>
                        </tr>
                        <tr>
                            <th>Pekerjaan</th>
                            <td>{{ $uji->pekerjaan }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th>Penghasilan</th>
                            <td>Rp {{ number_format($uji->penghasilan, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Tabungan</th>
                            <td>Rp {{ number_format($uji->tabungan, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Pinjaman</th>
                            <td>Rp {{ number_format($uji->pinjaman, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h5>Hasil Prediksi</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-{{ $predictedStatus == 'Layak' ? 'success' : 'danger' }}">
                <h4 class="alert-heading">Status Kelayakan: 
                    <strong>{{ $predictedStatus }}</strong>
                </h4>
                <p>Berdasarkan perhitungan KNN dengan 5 tetangga terdekat</p>
                <hr>
                <p class="mb-0">
                    <strong>Distribusi Voting:</strong><br>
                    Layak: {{ $frequency['Layak'] }} | 
                    Tidak Layak: {{ $frequency['Tidak Layak'] }} | 
                    -: {{ $frequency['-'] }}
                </p>
            </div>
            
            <form action="{{ route('knn.updateStatus', $uji->id) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status_persetujuan" class="form-label">Konfirmasi Status</label>
                            <select class="form-select" id="status_persetujuan" name="status_persetujuan" required>
                                <option value="diterima" {{ $predictedStatus == 'Layak' ? 'selected' : '' }}>Diterima</option>
                                <option value="ditolak" {{ $predictedStatus == 'Tidak Layak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Keputusan
                </button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>5 Tetangga Terdekat</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Penghasilan</th>
                            <th>Tabungan</th>
                            <th>Pinjaman</th>
                            <th>Status Pinjaman</th>
                            <th>Status Kelayakan</th>
                            <th>Jarak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nearestNeighbors as $index => $neighbor)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $neighbor['data']->nik }}</td>
                            <td>{{ $neighbor['data']->nama }}</td>
                            <td>Rp {{ number_format($neighbor['data']->penghasilan, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($neighbor['data']->jumlah_tabungan, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($neighbor['data']->jumlah_pinjaman, 0, ',', '.') }}</td>
                            <td>{{ $neighbor['data']->status_pinjaman }}</td>
                            <td>
                                <span class="badge 
                                    @if($neighbor['status_kelayakan'] == 'Layak') bg-success
                                    @elseif($neighbor['status_kelayakan'] == 'Tidak Layak') bg-danger
                                    @else bg-secondary @endif">
                                    {{ $neighbor['status_kelayakan'] }}
                                </span>
                            </td>
                            <td>{{ number_format($neighbor['distance'], 4) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection