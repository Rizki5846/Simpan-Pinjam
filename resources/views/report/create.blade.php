@extends('layouts.app')

@section('title', 'Form Report Petani')

@section('content')
  <form action="{{ route('report.create.store') }}" method ="POST">
    @csrf
    <div class="row">
      <div class="col-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Petani</h6>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="nama_petani">Nama Petani</label>
              <input type="text" class="form-control" id="nama_petani" name="nama_petani" required >
            </div>
             <div class="form-group">
              <label for="alamat">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" required>
            </div>
             <div class="form-group">
              <label for="no_tlp">Nomor Telepon</label>
              <input type="number" class="form-control" id="no_tlp" name="no_tlp" required>
            </div>
            <div class="form-group">
              <label for="benih">Benih</label>
              <input type="text" class="form-control" id="benih" name="benih" required>
            </div>
            <div class="form-group">
              <label for="jumlah_benih">Jumlah Benih</label>
              <input type="number" class="form-control" id="jumlah_benih" name="jumlah_benih" required>
            </div>
            
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          
        </div>
      </div>
    </div>
  </form>
@endsection
{{-- @if (auth()->user()->level == 'Admin') --}}