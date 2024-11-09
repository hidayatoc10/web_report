@extends('../../layouts/sidebar_admin')

@section('container')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Akun Saya</h1>
            <div class="d-flex gap-2">
                <a href="akun_saya" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"
                    style="margin-right: 10px">
                    <i class="fas fa-sync-alt text-white-100"></i> Refresh
                </a>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Akun Saya</h6>
            </div>
            <div class="card-body">
                @if (session('berhasil_diupdate'))
                    <div class="alert alert-primary" role="alert">
                        Data berhasil diperbarui
                    </div>
                @endif
                @if (session('dataganemu'))
                    <div class="alert alert-danger" role="alert">
                        Data tidak ditemukan
                    </div>
                @endif
                @if (session('datagagal'))
                    <div class="alert alert-danger" role="alert">
                        Data gagal di ubah, dikarenakan ada yang memakai Data ini
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{ auth()->user()->name }}</td>
                                <td>{{ auth()->user()->username }}</td>
                                <td>{{ auth()->user()->email }}</td>
                                <td>{{ auth()->user()->keterangan }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="#" class="btn btn-sm btn-primary shadow-sm edit-btn"
                                            style="margin-right: 10px;" data-toggle="modal" data-target="#editModal">
                                            <i class="fas fa-edit text-white-100"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
