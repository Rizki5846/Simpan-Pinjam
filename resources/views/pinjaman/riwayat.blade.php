@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Data Pinjaman</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Pekerjaan</th>
                <th>Penghasilan</th>
                <th>Tabungan</th>
                <th>Pinjaman</th>
                <th>Status Proses</th>
                <th>Status Pinjaman</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengajuan as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->pekerjaan }}</td>
                    <td>{{ $item->penghasilan }}</td>
                    <td>{{ $item->tabungan }}</td>
                    <td>{{ $item->pinjaman }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->status_pinjaman }}</td>
                    <td>
                        <div class="d-flex flex-column gap-2">

                            {{-- Form ubah status pinjaman --}}
                            <form action="{{ route('pinjaman.updateStatus', $item->id) }}" method="POST" class="d-flex">
                                @csrf
                                <select name="status_pinjaman" class="form-select me-2" required>
                                    <option value="">Pilih</option>
                                    <option value="belum diproses" {{ $item->status_pinjaman == 'belum diproses' ? 'selected' : '' }}>Belum Diproses</option>
                                    <option value="diterima" {{ $item->status_pinjaman == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                    <option value="ditolak" {{ $item->status_pinjaman == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    <option value="lunas" {{ $item->status_pinjaman == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">Ubah</button>
                            </form>

                            {{-- Form kirim ke uji --}}
                           @if(strtolower($item->status ?? '') === 'pengajuan')
                                <form action="{{ route('pinjaman.kirimKeUji', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Kirim ke Uji</button>
                                </form>
                            @endif

                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
