@extends('../../layouts/sidebar_admin')

@section('container')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar Data Siswa</h1>
            <div class="d-flex gap-2">
                <a href="data_siswa" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"
                    style="margin-right: 10px">
                    <i class="fas fa-sync-alt text-white-100"></i> Refresh
                </a>
                <a href="tambah_siswa" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"
                    style="margin-right: 10px">
                    <i class="fas fa-user-plus text-white-100"></i> Tambah Siswa
                </a>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="print-btn">
                    <i class="fas fa-download fa-sm text-white-50"></i> Export Report
                </a>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
            </div>
            <div class="card-body">
                @if (session('berhasil_ditambah_siswa'))
                    <div class="alert alert-primary" role="alert">
                        Data siswa berhasil ditambahkan
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
                                <th>Nisn</th>
                                <th>Kode KK</th>
                                <th>Nama</th>
                                <th>Foto Siswa</th>
                                <th>Tanggal Tambah</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->NISN }}</td>
                                    <td>{{ $item->Kode_KK }}</td>
                                    <td>{{ $item->Nama_siswa }}</td>
                                    <td>
                                        <img src="storage/{{ $item->Foto_siswa }}" width="100"
                                            alt="{{ $item->Foto_siswa }}">
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="#" class="btn btn-sm btn-primary shadow-sm edit-btn"
                                                style="margin-right: 10px;" data-toggle="modal" data-target="#editModal"
                                                data-nisn="{{ $item->NISN }}" data-kodekk="{{ $item->Kode_KK }}"
                                                data-nama="{{ $item->Nama_siswa }}" data-alamat="{{ $item->Alamat_siswa }}"
                                                data-tgllahir="{{ $item->Tgl_lahir }}"
                                                data-foto="{{ $item->Foto_siswa }}">
                                                <i class="fas fa-edit text-white-100"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-info shadow-sm view-btn"
                                                data-toggle="modal" data-target="#viewModal" style="margin-right: 10px;"
                                                data-nisn="{{ $item->NISN }}" data-kodekk="{{ $item->Kode_KK }}"
                                                data-nama="{{ $item->Nama_siswa }}"
                                                data-alamat="{{ $item->Alamat_siswa }}"
                                                data-tgllahir="{{ $item->Tgl_lahir }}"
                                                data-updated="{{ $item->updated_at }}">
                                                <i class="fas fa-eye text-white-100"></i>
                                            </a>
                                            <a data-toggle="modal" data-target="#logoutModal"
                                                class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
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
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Detail Siswa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img id="view-foto" src="" alt="Foto Siswa" class="img-fluid mb-3"
                            style="max-height: 200px;">
                    </div>
                    <p><strong>NISN:</strong> <span id="view-nisn"></span></p>
                    <p><strong>Kode KK:</strong> <span id="view-kodekk"></span></p>
                    <p><strong>Nama:</strong> <span id="view-nama"></span></p>
                    <p><strong>Alamat:</strong> <span id="view-alamat"></span></p>
                    <p><strong>Tanggal Lahir:</strong> <span id="view-tgllahir"></span></p>
                    <p><strong>Tanggal Update:</strong> <span id="view-updated"></span></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
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
                <div class="modal-body">Apakah anda ingin menghapus siswa <span id="siswa-nama"></span>?</div>
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
                    <h5 class="modal-title" id="editModalLabel">Edit Siswa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit-nisn">NISN</label>
                            <input type="number" class="form-control @error('nisn') is-invalid @enderror" id="edit-nisn"
                                name="nisn" value="{{ old('nisn') }}" required>
                            @error('nisn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="edit-kodekk">Kode KK</label>
                            <input type="number" class="form-control @error('kode_kk') is-invalid @enderror"
                                id="edit-kodekk" name="kode_kk" value="{{ old('kode_kk') }}" required>
                            @error('kode_kk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="edit-nama">Nama Siswa</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="edit-nama"
                                name="nama" value="{{ old('nama') }}" required>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="edit-alamat">Alamat Siswa</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3"
                                placeholder="Masukkan Alamat" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="edit-tgllahir">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                id="edit-tgllahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="edit-foto">Foto Siswa</label>
                            <input type="file" class="form-control-file @error('foto') is-invalid @enderror"
                                id="edit-foto" name="foto">
                            @error('foto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.btn-danger').forEach(button => {
            button.addEventListener('click', function() {
                const siswaNama = this.closest('tr').querySelector('td:nth-child(4)').innerText;
                const NISN = this.closest('tr').querySelector('td:nth-child(2)').innerText;
                document.getElementById('siswa-nama').innerText = siswaNama;
                document.getElementById('confirm-hapus').href = `hapus_siswa/${NISN}`;
            });
        });

        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const nisn = this.getAttribute('data-nisn');
                const kodeKK = this.getAttribute('data-kodekk');
                const nama = this.getAttribute('data-nama');
                const alamat = this.getAttribute('data-alamat');
                const tglLahir = this.getAttribute('data-tgllahir');

                document.getElementById('edit-nisn').value = nisn;
                document.getElementById('edit-kodekk').value = kodeKK;
                document.getElementById('edit-nama').value = nama;
                document.getElementById('alamat').value = alamat;
                document.getElementById('edit-tgllahir').value = tglLahir;

                const formAction = `/update_siswa/${nisn}`;
                document.getElementById('editForm').action = formAction;
            });
        });

        document.querySelectorAll('.view-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('view-nisn').innerText = this.getAttribute('data-nisn');
                document.getElementById('view-kodekk').innerText = this.getAttribute('data-kodekk');
                document.getElementById('view-nama').innerText = this.getAttribute('data-nama');
                document.getElementById('view-alamat').innerText = this.getAttribute('data-alamat');
                document.getElementById('view-tgllahir').innerText = this.getAttribute('data-tgllahir');
                document.getElementById('view-updated').innerText = this.getAttribute('data-updated');
                document.getElementById('view-foto').src = this.getAttribute('data-foto');
            });
        });
        document.getElementById('print-btn').addEventListener('click', function() {
            const actionButtons = document.querySelectorAll('.btn');
            actionButtons.forEach(button => {
                button.style.display = 'none';
            });
            const header = document.querySelector('.container-fluid > .d-sm-flex');
            if (header) header.style.display = 'none';
            window.print();
            actionButtons.forEach(button => {
                button.style.display = '';
            });
            if (header) header.style.display = '';
        });
    </script>
@endsection
