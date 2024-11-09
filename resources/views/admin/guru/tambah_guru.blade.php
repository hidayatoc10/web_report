@extends('../../layouts/sidebar_admin')

@section('container')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Data Guru</h1>
            <a href="data_guru" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Guru</h6>
            </div>
            <div class="card-body">
                <form action="tambah_guru" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="Kode_guru" class="form-label"><i class="fas fa-code"></i> Kode Guru</label>
                        <input type="number" class="form-control @error('Kode_guru') is-invalid @enderror" autofocus
                            id="Kode_guru" name="Kode_guru" placeholder="Masukkan Kode Guru" value="{{ old('Kode_guru') }}"
                            required>
                        @error('Kode_guru')
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
                            @foreach ($siswa as $siswa)
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
                        <label for="Nama_guru" class="form-label"><i class="fas fa-user"></i> Nama Guru</label>
                        <input type="text" class="form-control @error('Nama_guru') is-invalid @enderror" id="Nama_guru"
                            name="Nama_guru" placeholder="Masukkan Nama Guru" value="{{ old('Nama_guru') }}" required>
                        @error('Nama_guru')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="NIP" class="form-label"><i class="fas fa-briefcase"></i> Nip</label>
                        <input type="number" class="form-control @error('NIP') is-invalid @enderror" id="NIP"
                            name="NIP" placeholder="Masukkan NIP Guru" value="{{ old('NIP') }}" required>
                        @error('NIP')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Alamat_guru" class="form-label"><i class="fas fa-home"></i> Alamat Guru</label>
                        <textarea class="form-control @error('Alamat_guru') is-invalid @enderror" id="Alamat_guru" name="Alamat_guru"
                            rows="3" placeholder="Masukkan Alamat Guru" required>{{ old('Alamat_guru') }}</textarea>
                        @error('Alamat_guru')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Telp_guru" class="form-label"><i class="fas fa-phone"></i> Telepon Guru</label>
                        <input type="number" class="form-control @error('Telp_guru') is-invalid @enderror" id="Telp_guru"
                            name="Telp_guru" placeholder="Masukkan Telepon Guru" value="{{ old('Telp_guru') }}">
                        @error('Telp_guru')
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
