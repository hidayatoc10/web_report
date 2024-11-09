@extends('../../layouts/sidebar_admin')

@section('container')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Data Kompetisi Keahlian</h1>
            <a href="kompetensi_keahlian" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Kompetisi Keahlian</h6>
            </div>
            <div class="card-body">
                <form action="tambah_kompetensi_keahlian" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="Kode_KK" class="form-label"><i class="fas fa-code"></i> Kode KK</label>
                        <input type="number" class="form-control @error('Kode_KK') is-invalid @enderror" autofocus
                            id="Kode_KK" name="Kode_KK" placeholder="Masukkan Kode KK" value="{{ old('Kode_KK') }}"
                            required>
                        @error('Kode_KK')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Kode_mata_diklat" class="form-label"><i class="fas fa-id-card"></i> Kode Mata
                            Diklat</label>
                        <select class="form-control @error('Kode_mata_diklat') is-invalid @enderror" id="Kode_mata_diklat"
                            name="Kode_mata_diklat" required>
                            <option value="">-- Kode Meta Diklat --</option>
                            @foreach ($siswa as $siswa)
                                <option value="{{ $siswa->Kode_mata_diklat }}">{{ $siswa->Kode_mata_diklat }} -
                                    {{ $siswa->Nama_mata_diklat }}</option>
                            @endforeach
                        </select>
                        @error('Kode_mata_diklat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Nama_kompetensi_keahlian" class="form-label"><i class="fas fa-user"></i> Nama Kompetisi
                            Keahlian</label>
                        <input type="text" class="form-control @error('Nama_kompetensi_keahlian') is-invalid @enderror"
                            id="Nama_kompetensi_keahlian" name="Nama_kompetensi_keahlian"
                            placeholder="Masukkan Nama Kompetisi" value="{{ old('Nama_kompetensi_keahlian') }}" required>
                        @error('Nama_kompetensi_keahlian')
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
