@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Klasifikasi KNN - Data Uji</h2>
    
    <div class="card mb-4">
        <div class="card-body">
            <p class="mb-0">Berikut adalah data yang siap untuk diklasifikasi menggunakan algoritma KNN.</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Penghasilan</th>
                            <th>Tabungan</th>
                            <th>Pinjaman</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ujiData as $uji)
                        <tr>
                            <td>{{ $uji->nik }}</td>
                            <td>{{ $uji->nama }}</td>
                            <td>Rp {{ number_format($uji->penghasilan, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($uji->tabungan, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($uji->pinjaman, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-warning text-dark">
                                    {{ ucfirst($uji->status_persetujuan) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('knn.classify', $uji->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-calculator"></i> Klasifikasi
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection