@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Pilih Data Uji</h4>

    <form action="{{ route('penghitunganKnn.klasifikasi') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="k">Masukkan Nilai K:</label>
            <input type="number" name="k" class="form-control" required min="1">
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Pilih</th>
                    <th>Nama</th>
                    <th>Pekerjaan</th>
                    <th>Penghasilan</th>
                    <th>Status Pembayaran</th>
                    <th>Keanggotaan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dataUji as $data)
                <tr>
                    <td><input type="checkbox" name="uji_id[]" value="{{ $data->id }}"></td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->pekerjaan }}</td>
                    <td>{{ $data->penghasilan }}</td>
                    <td>{{ $data->status_pembayaran }}</td>
                    <td>{{ $data->keanggotaan_koperasi }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button class="btn btn-primary" type="submit">Mulai Klasifikasi</button>
    </form>
</div>
@endsection
