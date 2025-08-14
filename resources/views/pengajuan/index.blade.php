@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Pengajuan</h2>
        <a href="{{ route('pengajuan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Pengajuan
        </a>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Pekerjaan</th>
                    <th>Penghasilan</th>
                    <th>Tabungan</th>
                    <th>Pinjaman</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengajuan as $p)
                <tr>
                    <td>{{ $p->nik }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->pekerjaan }}</td>
                    <td>{{ number_format($p->penghasilan, 0, ',', '.') }}</td>
                    <td>{{ number_format($p->tabungan, 0, ',', '.') }}</td>
                    <td>{{ number_format($p->pinjaman, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge 
                            @if($p->status_persetujuan == 'diterima') bg-success
                            @elseif($p->status_persetujuan == 'ditolak') bg-danger
                            @else bg-warning text-dark @endif">
                            {{ ucfirst($p->status_persetujuan) }}
                        </span>
                    </td>
                    <td>{{ $p->created_at->format('d/m/Y') }}</td>
                    <td>
                        @if(auth()->user()->role == 'Admin')
                        <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $p->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                Ubah Status
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $p->id }}">
                                <li>
                                    <form action="{{ route('pengajuan.updateStatus', $p->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="diterima">
                                        <button type="submit" class="dropdown-item">Diterima</button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('pengajuan.updateStatus', $p->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit" class="dropdown-item">Ditolak</button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('pengajuan.updateStatus', $p->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="sedang proses">
                                        <button type="submit" class="dropdown-item">Sedang Proses</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection