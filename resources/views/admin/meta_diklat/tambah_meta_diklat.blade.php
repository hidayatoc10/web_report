@extends('../../layouts/sidebar_admin')

@section('container')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Data Meta Diklat</h1>
            <a href="data_meta_diklat" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Meta Diklat</h6>
            </div>
            <div class="card-body">
                <form action="tambah_meta_diklat" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="Kode_mata_diklat" class="form-label"><i class="fas fa-code"></i> Kode Meta
                            Diklat</label>
                        <input type="number" class="form-control @error('Kode_mata_diklat') is-invalid @enderror" autofocus
                            id="Kode_mata_diklat" name="Kode_mata_diklat" placeholder="Masukkan Kode Meta Diklat"
                            value="{{ old('Kode_mata_diklat') }}" required>
                        @error('Kode_mata_diklat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Nama_mata_diklat" class="form-label"><i class="fas fa-user"></i> Nama Meta
                            Diklat</label>
                        <input type="text" class="form-control @error('Nama_mata_diklat') is-invalid @enderror"
                            id="Nama_mata_diklat" name="Nama_mata_diklat" placeholder="Masukkan Nama Meta Diklat"
                            value="{{ old('Nama_mata_diklat') }}" required>
                        @error('Nama_mata_diklat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
