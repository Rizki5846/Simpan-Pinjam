@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Anggota</h2>
    <a href="{{ route('anggota.create') }}" class="btn btn-primary mb-3">Tambah Anggota</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Pekerjaan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($anggota as $agt)
            <tr>
                <td>{{ $agt->nik }}</td>
                <td>{{ $agt->nama }}</td>
                <td>{{ $agt->pekerjaan }}</td>
                <td>
                    @if($agt->latih)
                        <span class="badge bg-success">Sudah Latih</span>
                    @else
                        <span class="badge bg-warning">Belum Latih</span>
                    @endif
                </td>
                <td>
                    @if(!$agt->latih)
                    <form action="{{ route('anggota.convert', $agt->id) }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="status_kelayakan" value="Layak">
                        <button type="submit" class="btn btn-sm btn-success">Jadikan Latih (Layak)</button>
                    </form>
                    <form action="{{ route('anggota.convert', $agt->id) }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="status_kelayakan" value="Tidak Layak">
                        <button type="submit" class="btn btn-sm btn-danger">Jadikan Latih (Tidak Layak)</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection