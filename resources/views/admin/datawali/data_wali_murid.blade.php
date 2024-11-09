@extends('../../layouts/sidebar_admin')

@section('container')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Wali Siswa</h1>
            <div class="d-flex gap-2">
                <a href="data_wali_murid" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"
                    style="margin-right: 10px">
                    <i class="fas fa-sync-alt text-white-100"></i> Refresh
                </a>
                <a href="tambah_wali" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"
                    style="margin-right: 10px">
                    <i class="fas fa-user-plus text-white-100"></i> Tambah Wali Siswa
                </a>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-primary" role="alert">
                        Data Wali berhasil ditambahkan
                    </div>
                @endif
                @if (session('dihapus'))
                    <div class="alert alert-primary" role="alert">
                        Data siswa berhasil dihapus
                    </div>
                @endif
                @if (session('berhasil_diupdate'))
                    <div class="alert alert-primary" role="alert">
                        Data siswa berhasil diperbarui
                    </div>
                @endif
                @if (session('dataganemu'))
                    <div class="alert alert-danger" role="alert">
                        Data siswa tidak ditemukan
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>NISN</th>
                                <th>Nama Anak</th>
                                <th>Nama Orang Tua</th>
                                <th>Tanggal Tambah</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datawali as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->Kode_wali }}</td>
                                    <td>{{ $item->siswa->NISN }}</td>
                                    <td>{{ $item->siswa->Nama_siswa }}</td>
                                    <td>{{ $item->Nama_ayah }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="#" class="btn btn-sm btn-primary shadow-sm edit-btn"
                                                data-id="{{ $item->Kode_wali }}" data-toggle="modal"
                                                style="margin-right: 10px;" data-target="#editModal">
                                                <i class="fas fa-edit text-white-100"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-danger shadow-sm delete-btn"
                                                data-id="{{ $item->Kode_wali }}" data-toggle="modal"
                                                data-target="#logoutModal">
                                                <i class="fas fa-trash text-white-100"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah anda ingin menghapus wali murid?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a id="confirm-hapus" class="btn btn-primary" href="#">Hapus</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Wali Murid</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="updateForm" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="NISN"><i class="fas fa-id-card"></i> NISN</label>
                            <select class="form-control @error('NISN') is-invalid @enderror" id="NISN"
                                name="NISN"></select>
                            @error('NISN')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Kode_wali"><i class="fas fa-code"></i> Kode Wali</label>
                                    <input type="text" class="form-control @error('Kode_wali') is-invalid @enderror"
                                        id="Kode_wali" name="Kode_wali" value="{{ old('Kode_wali') }}"
                                        placeholder="Masukkan Nama Ayah">
                                    @error('Kode_wali')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Nama_ayah"><i class="fas fa-user"></i> Nama Ayah</label>
                                    <input type="text" class="form-control @error('Nama_ayah') is-invalid @enderror"
                                        id="Nama_ayah" name="Nama_ayah" value="{{ old('Nama_ayah') }}"
                                        placeholder="Masukkan Nama Ayah">
                                    @error('Nama_ayah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Pekerjaan_ayah"><i class="fas fa-briefcase"></i> Pekerjaan Ayah</label>
                                    <input type="text"
                                        class="form-control @error('Pekerjaan_ayah') is-invalid @enderror"
                                        id="Pekerjaan_ayah" name="Pekerjaan_ayah" value="{{ old('Pekerjaan_ayah') }}"
                                        placeholder="Masukkan Pekerjaan Ayah">
                                    @error('Pekerjaan_ayah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Nama_ibu"><i class="fas fa-user"></i> Nama Ibu</label>
                                    <input type="text" class="form-control @error('Nama_ibu') is-invalid @enderror"
                                        id="Nama_ibu" name="Nama_ibu" value="{{ old('Nama_ibu') }}"
                                        placeholder="Masukkan Nama Ibu">
                                    @error('Nama_ibu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Pekerjaan_ibu"><i class="fas fa-briefcase"></i> Pekerjaan Ibu</label>
                                    <input type="text"
                                        class="form-control @error('Pekerjaan_ibu') is-invalid @enderror"
                                        id="Pekerjaan_ibu" name="Pekerjaan_ibu" value="{{ old('Pekerjaan_ibu') }}"
                                        placeholder="Masukkan Pekerjaan Ibu">
                                    @error('Pekerjaan_ibu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Telp_wali"><i class="fas fa-phone"></i> Telepon Wali</label>
                                    <input type="text" class="form-control @error('Telp_wali') is-invalid @enderror"
                                        id="Telp_wali" name="Telp_wali" value="{{ old('Telp_wali') }}"
                                        placeholder="Masukkan Telepon Wali">
                                    @error('Telp_wali')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Alamat_wali"><i class="fas fa-home"></i> Alamat Wali</label>
                            <textarea class="form-control @error('Alamat_wali') is-invalid @enderror" id="Alamat_wali" name="Alamat_wali"
                                rows="3" placeholder="Masukkan Alamat Wali">{{ old('Alamat_wali') }}</textarea>
                            @error('Alamat_wali')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteBtns = document.querySelectorAll('.delete-btn');
            const confirmHapus = document.getElementById('confirm-hapus');

            deleteBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const kodeWali = this.getAttribute('data-id');
                    confirmHapus.setAttribute('href', '/hapus_wali/' + kodeWali);
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const editBtns = document.querySelectorAll('.edit-btn');
            const updateForm = document.getElementById('updateForm');
            const NISNSelect = document.getElementById('NISN');

            editBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const kodeWali = this.getAttribute('data-id');
                    fetch(`/edit_wali/${kodeWali}`)
                        .then(response => response.json())
                        .then(data => {
                            updateForm.action = `/update_wali/${kodeWali}`;
                            NISNSelect.innerHTML = '';
                            data.siswas.forEach(siswa => {
                                const option = document.createElement('option');
                                option.value = siswa.NISN;
                                option.textContent =
                                    `${siswa.NISN} - ${siswa.Nama_siswa}`;
                                if (siswa.NISN === data.wali.NISN) {
                                    option.selected = true;
                                }
                                NISNSelect.appendChild(option);
                            });

                            document.getElementById('Kode_wali').value = data.wali
                                .Kode_wali;
                            document.getElementById('Nama_ayah').value = data.wali.Nama_ayah;
                            document.getElementById('Pekerjaan_ayah').value = data.wali
                                .Pekerjaan_ayah;
                            document.getElementById('Nama_ibu').value = data.wali.Nama_ibu;
                            document.getElementById('Pekerjaan_ibu').value = data.wali
                                .Pekerjaan_ibu;
                            document.getElementById('Alamat_wali').value = data.wali
                                .Alamat_wali;
                            document.getElementById('Telp_wali').value = data.wali.Telp_wali;
                        });
                });
            });
        });
    </script>
@endsection
