@extends('../../layouts/sidebar_admin')

@section('container')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar Kompetensi Keahlian</h1>
            <div class="d-flex gap-2">
                <a href="kompetensi_keahlian" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"
                    style="margin-right: 10px">
                    <i class="fas fa-sync-alt text-white-100"></i> Refresh
                </a>
                <a href="tambah_kompetensi_keahlian" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"
                    style="margin-right: 10px">
                    <i class="fas fa-user-plus text-white-100"></i> Tambah Kompetensi Keahlian
                </a>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Kompetensi Keahlian</h6>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-primary" role="alert">
                        Data Kompetensi Keahlian berhasil ditambahkan
                    </div>
                @endif
                @if (session('dihapus'))
                    <div class="alert alert-primary" role="alert">
                        Data Kompetensi Keahlian berhasil dihapus
                    </div>
                @endif
                @if (session('berhasil_diupdate'))
                    <div class="alert alert-primary" role="alert">
                        Data Kompetensi Keahlian berhasil diperbarui
                    </div>
                @endif
                @if (session('dataganemu'))
                    <div class="alert alert-danger" role="alert">
                        Data Kompetensi Keahlian tidak ditemukan
                    </div>
                @endif
                @if (session('datagagal'))
                    <div class="alert alert-danger" role="alert">
                        Data Kompetensi Keahlian gagal di ubah, dikarenakan ada yang memakai data Kompetensi Keahlian ini
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode KK</th>
                                <th>Kode Meta Diklat</th>
                                <th>Nama Kompetensi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->Kode_KK }}</td>
                                    <td>{{ $item->mataDiklat->Kode_mata_diklat }}</td>
                                    <td>{{ $item->Nama_kompetensi_keahlian }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="#" class="btn btn-sm btn-primary shadow-sm edit-btn"
                                                style="margin-right: 10px;" data-toggle="modal" data-target="#editModal">
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
                <div class="modal-body">Apakah anda ingin menghapus Kompetensi Keahlian <span id="siswa-nama"></span>?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a id="confirm-hapus" class="btn btn-primary" href="#">Hapus</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Update -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Kompetensi Keahlian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="editForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="Kode_mata_diklat">Kode Mata Diklat</label>
                            <select class="form-control" name="Kode_mata_diklat" id="Kode_mata_diklat">
                                @foreach ($metaDiklat as $item)
                                    <option value="{{ $item->Kode_mata_diklat }}">{{ $item->Kode_mata_diklat }} -
                                        {{ $item->Nama_mata_diklat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Nama_kompetensi_keahlian">Nama Kompetensi Keahlian</label>
                            <input type="text" class="form-control" id="Nama_kompetensi_keahlian"
                                name="Nama_kompetensi_keahlian" required>
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
        document.querySelectorAll('.btn-danger').forEach(button => {
            button.addEventListener('click', function() {
                const siswaNama = this.closest('tr').querySelector('td:nth-child(4)').innerText;
                const Kode_KK = this.closest('tr').querySelector('td:nth-child(2)').innerText;
                document.getElementById('siswa-nama').innerText = siswaNama;
                document.getElementById('confirm-hapus').href = `hapus_kompetensi_keahlian/${Kode_KK}`;
            });
        });
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                const kodeKK = row.querySelector('td:nth-child(2)').innerText;
                const kodeMataDiklat = row.querySelector('td:nth-child(3)').innerText;
                const namaKompetensiKeahlian = row.querySelector('td:nth-child(4)').innerText;
                const editForm = document.getElementById('editForm');
                editForm.action = `/update_kompetensi_keahlian/${kodeKK}`;
                document.getElementById('Kode_mata_diklat').value = kodeMataDiklat;
                document.getElementById('Nama_kompetensi_keahlian').value = namaKompetensiKeahlian;
            });
        });
    </script>
@endsection
