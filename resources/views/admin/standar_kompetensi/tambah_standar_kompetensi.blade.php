@extends('../../layouts/sidebar_admin')

@section('container')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Data Standar Kompetisi</h1>
            <a href="standar_kompetensi" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Standar Kompetisi</h6>
            </div>
            <div class="card-body">
                <form action="tambah_standar_kompetensi" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="Kode_SK" class="form-label"><i class="fas fa-code"></i> Kode SK</label>
                        <input type="number" class="form-control @error('Kode_SK') is-invalid @enderror" autofocus
                            id="Kode_SK" name="Kode_SK" placeholder="Masukkan Kode Standar Kompetisi"
                            value="{{ old('Kode_SK') }}" required>
                        @error('Kode_SK')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Kode_KK" class="form-label"><i class="fas fa-id-card"></i> Kode KK</label>
                        <select class="form-control @error('Kode_KK') is-invalid @enderror" id="Kode_KK" name="Kode_KK"
                            required>
                            <option value="">-- Kode KK --</option>
                            @foreach ($data as $siswa)
                                <option value="{{ $siswa->Kode_KK }}">{{ $siswa->Kode_KK }} -
                                    {{ $siswa->Nama_kompetensi_keahlian }}</option>
                            @endforeach
                        </select>
                        @error('Kode_KK')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Nama_SK" class="form-label"><i class="fas fa-user"></i> Nama SK</label>
                        <input type="text" class="form-control @error('Nama_SK') is-invalid @enderror" id="Nama_SK"
                            name="Nama_SK" placeholder="Masukkan Nama Standar Kompetisi" value="{{ old('Nama_SK') }}"
                            required>
                        @error('Nama_SK')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Kelas_SK" class="form-label"><i class="fas fa-user"></i> Kelas SK</label>
                        <input type="text" class="form-control @error('Kelas_SK') is-invalid @enderror" id="Kelas_SK"
                            name="Kelas_SK" placeholder="Masukkan Kelas Standar Kompetisi" value="{{ old('Kelas_SK') }}"
                            required>
                        @error('Kelas_SK')
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
