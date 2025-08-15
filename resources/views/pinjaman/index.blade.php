@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Pengajuan Pinjaman</h2>
        <a href="{{ route('pengajuan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Buat Pengajuan Baru
        </a>
    </div>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama Anggota</th>
                <th>Jumlah Pinjaman</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengajuan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nik }}</td>
                <td>{{ $item->nama }}</td>
                <td>Rp {{ number_format($item->jumlah_pinjaman, 0, ',', '.') }}</td>
                <td>
                    <span class="badge bg-{{ $item->status == 'Disetujui' ? 'success' : ($item->status == 'Ditolak' ? 'danger' : 'warning') }}">
                        {{ $item->status }}
                    </span>
                </td>
                <td class="d-flex gap-2">
                    <a href="{{ route('pinjaman.show', $item->id) }}" class="btn btn-sm btn-info">
                        <i class="fas fa-eye"></i> Detail
                    </a>

                    {{-- Tombol Convert ke Data Uji --}}
                    <form action="{{ route('pinjaman.convert.uji', $item->id) }}" method="POST" 
                          onsubmit="return confirm('Yakin ingin convert ke Data Uji?')">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fas fa-random"></i> Convert
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
    