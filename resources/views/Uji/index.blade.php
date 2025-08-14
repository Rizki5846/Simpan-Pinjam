@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Proses Uji</h2>
    
    <div class="card mb-4">
        <div class="card-body">
            <a href="{{ route('uji.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Data Uji
            </a>
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
                            <th>Pinjaman</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($uji as $u)
                        <tr>
                            <td>{{ $u->nik }}</td>
                            <td>{{ $u->nama }}</td>
                            <td>Rp {{ number_format($u->pinjaman, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge 
                                    @if($u->status_persetujuan == 'diterima') bg-success
                                    @elseif($u->status_persetujuan == 'ditolak') bg-danger
                                    @else bg-warning text-dark @endif">
                                    {{ ucfirst($u->status_persetujuan) }}
                                </span>
                            </td>
                            <td>{{ $u->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('uji.show', $u->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye">Show</i>
                                </a>
                                <form action="{{ route('uji.destroy', $u->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data?')">
                                        <i class="fas fa-trash">Hapus</i>
                                    </button>
                                </form>
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