@extends('../../layouts/sidebar_admin')

@section('container')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar Standar Kompetensi</h1>
            <div class="d-flex gap-2">
                <a href="standar_kompetensi" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"
                    style="margin-right: 10px">
                    <i class="fas fa-sync-alt text-white-100"></i> Refresh
                </a>
                <a href="tambah_standar_kompetensi" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"
                    style="margin-right: 10px">
                    <i class="fas fa-user-plus text-white-100"></i> Tambah Standar Kompetensi
                </a>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Standar Kompetensi</h6>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-primary" role="alert">
                        Data Standar Kompetensi berhasil ditambahkan
                    </div>
                @endif
                @if (session('dihapus'))
                    <div class="alert alert-primary" role="alert">
                        Data Standar Kompetensi berhasil dihapus
                    </div>
                @endif
                @if (session('berhasil_diupdate'))
                    <div class="alert alert-primary" role="alert">
                        Data Standar Kompetensi berhasil diperbarui
                    </div>
                @endif
                @if (session('dataganemu'))
                    <div class="alert alert-danger" role="alert">
                        Data Standar Kompetensi tidak ditemukan
                    </div>
                @endif
                @if (session('datagagal'))
                    <div class="alert alert-danger" role="alert">
                        Data Standar Kompetensi gagal di ubah, dikarenakan ada yang memakai data standar kompetensi
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode SK</th>
                                <th>Kode KK</th>
                                <th>Nama SK</th>
                                <th>Kelas SK</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->Kode_SK }}</td>
                                    <td>{{ $item->kompetensiKeahlian->Kode_KK }}</td>
                                    <td>{{ $item->Nama_SK }}</td>
                                    <td>{{ $item->Kelas_SK }}</td>
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
                <div class="modal-body">Apakah anda ingin menghapus Standar Kompetensi <span id="siswa-nama"></span>?</div>
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
                    <h5 class="modal-title" id="editModalLabel">Edit Standar Kompetensi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updateForm" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="Kode_SK" class="form-label"><i class="fas fa-code"></i> Kode SK</label>
                            <input type="text" class="form-control @error('Kode_SK') is-invalid @enderror" id="Kode_SK"
                                name="Kode_SK" placeholder="Masukkan Kode Standar Kompetensi" value="{{ old('Kode_SK') }}"
                                required>
                            @error('Kode_SK')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="Kode_KK" class="form-label"><i class="fas fa-cogs"></i> Kode Kompetensi
                                Keahlian</label>
                            <select class="form-control @error('Kode_KK') is-invalid @enderror" id="Kode_KK"
                                name="Kode_KK" required>
                                <option value="">Pilih Kode KK</option>
                                @foreach ($kompetensiKeahlian as $kompetensi)
                                    <option value="{{ $kompetensi->Kode_KK }}">{{ $kompetensi->Nama_kompetensi_keahlian }}
                                        - {{ $kompetensi->Kode_KK }}
                                    </option>
                                @endforeach
                            </select>
                            @error('Kode_KK')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Nama SK -->
                        <div class="mb-3">
                            <label for="Nama_SK" class="form-label"><i class="fas fa-tag"></i> Nama SK</label>
                            <input type="text" class="form-control @error('Nama_SK') is-invalid @enderror"
                                id="Nama_SK" name="Nama_SK" placeholder="Masukkan Nama Standar Kompetensi"
                                value="{{ old('Nama_SK') }}" required>
                            @error('Nama_SK')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Kelas SK -->
                        <div class="mb-3">
                            <label for="Kelas_SK" class="form-label"><i class="fas fa-school"></i> Kelas SK</label>
                            <input type="text" class="form-control @error('Kelas_SK') is-invalid @enderror"
                                id="Kelas_SK" name="Kelas_SK" placeholder="Masukkan Kelas Standar Kompetensi"
                                value="{{ old('Kelas_SK') }}" required>
                            @error('Kelas_SK')
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
        document.querySelectorAll('.btn-danger').forEach(button => {
            button.addEventListener('click', function() {
                const siswaNama = this.closest('tr').querySelector('td:nth-child(4)').innerText;
                const Kode_SK = this.closest('tr').querySelector('td:nth-child(2)').innerText;
                document.getElementById('siswa-nama').innerText = siswaNama;
                document.getElementById('confirm-hapus').href = `hapus_standar_kompetensi/${Kode_SK}`;
            });
        });
        document.querySelectorAll('.btn-primary').forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                const Kode_SK = row.querySelector('td:nth-child(2)').textContent;
                const Kode_KK = row.querySelector('td:nth-child(3)').textContent;
                const Nama_SK = row.querySelector('td:nth-child(4)').textContent;
                const Kelas_SK = row.querySelector('td:nth-child(5)').textContent;
                document.getElementById('Kode_SK').value = Kode_SK;
                document.getElementById('Nama_SK').value = Nama_SK;
                document.getElementById('Kelas_SK').value = Kelas_SK;
                const formAction = `/update_standar_kompetensi/${Kode_SK}`;
                document.getElementById('updateForm').action = formAction;
                const kodeKKDropdown = document.getElementById('Kode_KK');
                for (let option of kodeKKDropdown.options) {
                    if (option.value === Kode_KK) {
                        option.selected = true;
                        break;
                    }
                }
                $('#editModal').modal('show');
            });
        });
    </script>
@endsection
