@extends('../../layouts/sidebar_admin')

@section('container')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar Data Guru</h1>
            <div class="d-flex gap-2">
                <a href="data_guru" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"
                    style="margin-right: 10px">
                    <i class="fas fa-sync-alt text-white-100"></i> Refresh
                </a>
                <a href="tambah_guru" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"
                    style="margin-right: 10px">
                    <i class="fas fa-user-plus text-white-100"></i> Tambah Guru
                </a>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Guru</h6>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-primary" role="alert">
                        Data guru berhasil ditambahkan
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
                                <th>Kode Guru</th>
                                <th>Kode KK</th>
                                <th>Nama Guru</th>
                                <th>NIP</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->Kode_guru }}</td>
                                    <td>{{ $item->kompetensiKeahlian->Kode_KK }}</td>
                                    <td>{{ $item->Nama_guru }}</td>
                                    <td>{{ $item->NIP }}</td>
                                    <td>{{ $item->Alamat_guru }}</td>
                                    <td>{{ $item->Telp_guru }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="#" class="btn btn-sm btn-primary shadow-sm edit-btn"
                                                style="margin-right: 10px;" data-toggle="modal" data-target="#editModal"
                                                data-kode="{{ $item->Kode_guru }}" data-nama="{{ $item->Nama_guru }}"
                                                data-nip="{{ $item->NIP }}" data-alamat="{{ $item->Alamat_guru }}"
                                                data-telp="{{ $item->Telp_guru }}" data-kodekk="{{ $item->Kode_KK }}">
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
                <div class="modal-body">Apakah anda ingin menghapus guru <span id="siswa-nama"></span>?</div>
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
                <form action="{{ route('update_guru', ':Kode_guru') }}" method="POST" id="edit-form">
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
                                <label for="Kode_guru" class="form-label"><i class="fas fa-code"></i> Kode Guru</label>
                                <input type="text" class="form-control @error('Kode_guru') is-invalid @enderror"
                                    id="edit-Kode_guru" name="Kode_guru" placeholder="Masukkan Kode Guru" required>
                                @error('Kode_guru')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="Nama_guru" class="form-label"><i class="fas fa-user"></i> Nama Guru</label>
                                <input type="text" class="form-control @error('Nama_guru') is-invalid @enderror"
                                    id="edit-Nama_guru" name="Nama_guru" placeholder="Masukkan Nama Guru" required>
                                @error('Nama_guru')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="Kode_KK" class="form-label"><i class="fas fa-id-card"></i> Kode KK</label>
                                <select class="form-control @error('Kode_KK') is-invalid @enderror" id="edit-Kode_KK"
                                    name="Kode_KK" required>
                                    <option value="">-- Pilih Kode KK --</option>
                                    @foreach ($kompetensiKeahlian as $kompetensi)
                                        <option value="{{ $kompetensi->Kode_KK }}">{{ $kompetensi->Kode_KK }} -
                                            {{ $kompetensi->Nama_kompetensi_keahlian }}</option>
                                    @endforeach
                                </select>
                                @error('Kode_KK')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="NIP" class="form-label"><i class="fas fa-briefcase"></i> NIP</label>
                                <input type="text" class="form-control @error('NIP') is-invalid @enderror"
                                    id="edit-NIP" name="NIP" placeholder="Masukkan NIP Guru" required>
                                @error('NIP')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="Alamat_guru" class="form-label"><i class="fas fa-map-marker-alt"></i>
                                    Alamat</label>
                                <textarea class="form-control @error('Alamat_guru') is-invalid @enderror" id="edit-Alamat_guru" name="Alamat_guru"
                                    rows="3" placeholder="Masukkan Alamat Guru" required></textarea>
                                @error('Alamat_guru')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="Telp_guru" class="form-label"><i class="fas fa-phone"></i> Telepon</label>
                                <input type="text" class="form-control @error('Telp_guru') is-invalid @enderror"
                                    id="edit-Telp_guru" name="Telp_guru" placeholder="Masukkan Telepon Guru" required>
                                @error('Telp_guru')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
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
                const Kode_guru = this.closest('tr').querySelector('td:nth-child(2)').innerText;
                document.getElementById('siswa-nama').innerText = siswaNama;
                document.getElementById('confirm-hapus').href = `hapus_guru/${Kode_guru}`;
            });
        });

        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const kodeGuru = this.getAttribute('data-kode');
                const namaGuru = this.getAttribute('data-nama');
                const nipGuru = this.getAttribute('data-nip');
                const alamatGuru = this.getAttribute('data-alamat');
                const telpGuru = this.getAttribute('data-telp');
                const kodeKK = this.getAttribute('data-kodekk');
                document.getElementById('edit-Nama_guru').value = namaGuru;
                document.getElementById('edit-NIP').value = nipGuru;
                document.getElementById('edit-Alamat_guru').value = alamatGuru;
                document.getElementById('edit-Telp_guru').value = telpGuru;
                document.getElementById('edit-Kode_KK').value = kodeKK;
                document.getElementById('edit-Kode_guru').value = kodeGuru;
                const formAction = `/update_guru/${kodeGuru}`;
                document.getElementById('edit-form').action = formAction;
            });
        });

        document.querySelectorAll('.view-btn').forEach(button => {
            button.addEventListener('click', function() {
                alert("View button clicked");
            });
        });
    </script>
@endsection
