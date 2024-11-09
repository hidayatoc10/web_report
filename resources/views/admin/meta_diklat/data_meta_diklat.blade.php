@extends('../../layouts/sidebar_admin')

@section('container')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar Data Meta Diklat</h1>
            <div class="d-flex gap-2">
                <a href="data_meta_diklat" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"
                    style="margin-right: 10px">
                    <i class="fas fa-sync-alt text-white-100"></i> Refresh
                </a>
                <a href="tambah_meta_diklat" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"
                    style="margin-right: 10px">
                    <i class="fas fa-user-plus text-white-100"></i> Tambah Meta Diklat
                </a>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Meta Diklat</h6>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-primary" role="alert">
                        Data Meta Diklat berhasil ditambahkan
                    </div>
                @endif
                @if (session('dihapus'))
                    <div class="alert alert-primary" role="alert">
                        Data meta diklat berhasil dihapus
                    </div>
                @endif
                @if (session('berhasil_diupdate'))
                    <div class="alert alert-primary" role="alert">
                        Data meta diklat berhasil diperbarui
                    </div>
                @endif
                @if (session('dataganemu'))
                    <div class="alert alert-danger" role="alert">
                        Data meta diklat tidak ditemukan
                    </div>
                @endif
                @if (session('datagagal'))
                    <div class="alert alert-danger" role="alert">
                        Data meta diklat gagal di ubah, dikarenakan ada yang memakai data meta diklat ini
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Meta Diklat</th>
                                <th>Nama Meta Diklat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->Kode_mata_diklat }}</td>
                                    <td>{{ $item->Nama_mata_diklat }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="#" class="btn btn-sm btn-primary shadow-sm edit-btn"
                                                data-kode="{{ $item->Kode_mata_diklat }}"
                                                data-mata="{{ $item->Nama_mata_diklat }}" style="margin-right: 10px;"
                                                data-toggle="modal" data-target="#editModal">
                                                <i class="fas fa-edit text-white-100"></i>
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
                <div class="modal-body">Apakah anda ingin menghapus meta diklat <span id="Nama_mata_diklat"></span>?</div>
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
                <form action="{{ route('update_meta_diklat', ':Kode_mata_diklat') }}" method="POST" id="edit-form">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data Guru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="Kode_mata_diklat" class="form-label"><i class="fas fa-code"></i> Kode Mata
                                    Diklat</label>
                                <input type="text" class="form-control @error('Kode_mata_diklat') is-invalid @enderror"
                                    id="Kode_mata_diklat" name="Kode_mata_diklat" placeholder="Masukkan Nama Guru"
                                    required>
                                @error('Kode_mata_diklat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="Nama_mata_diklat" class="form-label"><i class="fas fa-user"></i> Nama Mata
                                    Diklat
                                    Guru</label>
                                <input type="text" class="form-control @error('Nama_mata_diklat') is-invalid @enderror"
                                    id="Nama_mata_diklat" name="Nama_mata_diklat" placeholder="Masukkan Mata Diklat Guru"
                                    required>
                                @error('Nama_mata_diklat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const Kode_mata_diklat = this.getAttribute('data-kode');
                const Nama_mata_diklat = this.getAttribute('data-mata');
                document.getElementById('Nama_mata_diklat').value = Nama_mata_diklat;
                document.getElementById('Kode_mata_diklat').value = Kode_mata_diklat;
                const formAction = `/update_meta_diklat/${Kode_mata_diklat}`;
                document.getElementById('edit-form').action = formAction;
            });
        });

        document.querySelectorAll('.view-btn').forEach(button => {
            button.addEventListener('click', function() {
                alert("View button clicked");
            });
        });

        document.querySelectorAll('.btn-danger').forEach(button => {
            button.addEventListener('click', function() {
                const siswaNama = this.closest('tr').querySelector('td:nth-child(3)').innerText;
                const Kode_guru = this.closest('tr').querySelector('td:nth-child(2)').innerText;
                document.getElementById('Nama_mata_diklat').innerText = siswaNama;
                document.getElementById('confirm-hapus').href = `hapus_meta_diklat/${Kode_guru}`;
            });
        });
    </script>
@endsection
