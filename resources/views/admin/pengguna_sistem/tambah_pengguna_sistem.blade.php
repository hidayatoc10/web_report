@extends('../../layouts/sidebar_admin')

@section('container')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Data Pengguna Sistem</h1>
            <a href="data_pengguna_sistem" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Pengguna Sistem</h6>
            </div>
            <div class="card-body">
                <form action="tambah_pengguna_sistem" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label"><i class="fas fa-user"></i> Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" autofocus
                            id="name" name="name" placeholder="Masukkan Nama" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label"><i class="fas fa-user-tag"></i> Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" autofocus
                            id="username" name="username" placeholder="Masukkan Username" value="{{ old('username') }}"
                            required>
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" autofocus
                            id="email" name="email" placeholder="Masukkan Email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"><i class="fas fa-lock"></i> Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" autofocus
                            id="password" name="password" placeholder="Masukkan Password" value="{{ old('password') }}"
                            required>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label"><i class="fas fa-id-badge"></i> Kode Mata Diklat</label>
                        <select class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                            name="keterangan" required>
                            <option value="">-- Pilih Kode Mata Diklat --</option>
                            <option value="Admin">Admin</option>
                            <option value="Guru">Guru</option>
                            <option value="Wali Murid">Wali Murid</option>
                        </select>
                        @error('keterangan')
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
