@extends('../../layouts/sidebar_admin')

@section('container')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Data Wali</h1>
            <a href="data_wali_murid" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Wali</h6>
            </div>
            <div class="card-body">
                <form action="tambah_wali" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="Kode_wali" class="form-label"><i class="fas fa-code"></i> Kode Wali</label>
                        <input type="number" class="form-control @error('Kode_wali') is-invalid @enderror" autofocus
                            id="Kode_wali" name="Kode_wali" placeholder="Masukkan Kode Wali" value="{{ old('Kode_wali') }}"
                            required>
                        @error('Kode_wali')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="NISN" class="form-label"><i class="fas fa-id-card"></i> NISN Siswa</label>
                        <select class="form-control @error('NISN') is-invalid @enderror" id="NISN" name="NISN"
                            required>
                            <option value="">-- Pilih Siswa --</option>
                            @foreach ($siswa as $siswa)
                                <option value="{{ $siswa->NISN }}">{{ $siswa->NISN }} - {{ $siswa->Nama_siswa }}</option>
                            @endforeach
                        </select>
                        @error('NISN')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Nama_ayah" class="form-label"><i class="fas fa-user"></i> Nama Ayah</label>
                        <input type="text" class="form-control @error('Nama_ayah') is-invalid @enderror" id="Nama_ayah"
                            name="Nama_ayah" placeholder="Masukkan Nama Ayah" value="{{ old('Nama_ayah') }}" required>
                        @error('Nama_ayah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Pekerjaan_ayah" class="form-label"><i class="fas fa-briefcase"></i> Pekerjaan
                            Ayah</label>
                        <input type="text" class="form-control @error('Pekerjaan_ayah') is-invalid @enderror"
                            id="Pekerjaan_ayah" name="Pekerjaan_ayah" placeholder="Masukkan Pekerjaan Ayah"
                            value="{{ old('Pekerjaan_ayah') }}" required>
                        @error('Pekerjaan_ayah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Nama_ibu" class="form-label"><i class="fas fa-user"></i> Nama Ibu</label>
                        <input type="text" class="form-control @error('Nama_ibu') is-invalid @enderror" id="Nama_ibu"
                            name="Nama_ibu" placeholder="Masukkan Nama Ibu" value="{{ old('Nama_ibu') }}" required>
                        @error('Nama_ibu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Pekerjaan_ibu" class="form-label"><i class="fas fa-briefcase"></i> Pekerjaan Ibu</label>
                        <input type="text" class="form-control @error('Pekerjaan_ibu') is-invalid @enderror"
                            id="Pekerjaan_ibu" name="Pekerjaan_ibu" placeholder="Masukkan Pekerjaan Ibu"
                            value="{{ old('Pekerjaan_ibu') }}">
                        @error('Pekerjaan_ibu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Alamat_wali" class="form-label"><i class="fas fa-home"></i> Alamat Wali</label>
                        <textarea class="form-control @error('Alamat_wali') is-invalid @enderror" id="Alamat_wali" name="Alamat_wali"
                            rows="3" placeholder="Masukkan Alamat_wali" required>{{ old('Alamat_wali') }}</textarea>
                        @error('Alamat_wali')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Telp_wali" class="form-label"><i class="fas fa-phone"></i> Telepon Wali</label>
                        <input type="number" class="form-control @error('Telp_wali') is-invalid @enderror" id="Telp_wali"
                            name="Telp_wali" placeholder="Masukkan Telepon Wali" value="{{ old('Telp_wali') }}">
                        @error('Telp_wali')
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
