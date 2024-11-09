@extends('../../layouts/sidebar_admin')

@section('container')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Data Siswa</h1>
            <a href="data_siswa" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Siswa</h6>
            </div>
            <div class="card-body">
                <form action="tambah_siswa" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nisn" class="form-label"><i class="fas fa-id-card"></i> NISN</label>
                        <input type="number" class="form-control @error('nisn') is-invalid @enderror" id="nisn"
                            name="nisn" maxlength="10" placeholder="Masukkan NISN" value="{{ old('nisn') }}" autofocus
                            required>
                        @error('nisn')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kode_kk" class="form-label"><i class="fas fa-code"></i> Kode KK</label>
                        <input type="number" class="form-control @error('kode_kk') is-invalid @enderror" id="kode_kk"
                            name="kode_kk" maxlength="10" placeholder="Masukkan Kode KK" value="{{ old('kode_kk') }}"
                            required>
                        @error('kode_kk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label"><i class="fas fa-user"></i> Nama Siswa</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            name="nama" placeholder="Masukkan Nama Siswa" value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label"><i class="fas fa-map-marker-alt"></i> Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3"
                            placeholder="Masukkan Alamat" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label"><i class="fas fa-calendar-alt"></i> Tanggal
                            Lahir</label>
                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                            id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                        @error('tanggal_lahir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label"><i class="fas fa-camera"></i> Foto Siswa</label>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                            name="foto" accept="image/*">
                        @error('foto')
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
