<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\WaliKelasController;
use Illuminate\Support\Facades\Route;

Route::middleware("guest")->group(function () {
    Route::get('/login', [AuthController::class, 'login_ui'])->name('login');
    Route::post('/login', [AuthController::class, 'login_be']);
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard_admin', [AdminController::class, 'dashboard_admin'])->name('dashboard_admin');
    Route::get('/data_siswa', [AdminController::class, 'data_siswa'])->name('data_siswa');
    Route::get('/tambah_siswa', [AdminController::class, 'tambah_siswa']);
    Route::post('/tambah_siswa', [AdminController::class, 'storeSiswa']);
    Route::get('/hapus_siswa/{NISN}', [AdminController::class, 'hapus_siswa']);
    Route::put('/update_siswa/{NISN}', [AdminController::class, 'updateSiswa'])->name('update_siswa');
    Route::get('/data_wali_murid', [AdminController::class, 'data_wali_murid'])->name('data_wali_murid');
    Route::get('/tambah_wali', [AdminController::class, 'tambah_wali'])->name('tambah_wali');
    Route::post('/tambah_wali', [AdminController::class, 'storeWali'])->name('store_wali');
    Route::get('/hapus_wali/{Kode_wali}', [AdminController::class, 'hapus_wali']);
    Route::get('/edit_wali/{Kode_wali}', [AdminController::class, 'editWali'])->name('edit_wali');
    Route::put('/update_wali/{Kode_wali}', [AdminController::class, 'updateWali'])->name('update_wali');
    Route::get('/data_guru', [AdminController::class, 'data_guru'])->name('data_guru');
    Route::get('/tambah_guru', [AdminController::class, 'tambah_guru'])->name('tambah_guru');
    Route::post('/tambah_guru', [AdminController::class, 'tambah_guru_storage']);
    Route::get('/hapus_guru/{Kode_guru}', [AdminController::class, 'hapus_guru']);
    Route::put('/update_guru/{Kode_guru}', [AdminController::class, 'updateGuru'])->name('update_guru');
    Route::get('/data_meta_diklat', [AdminController::class, 'data_meta_diklat'])->name('data_meta_diklat');
    Route::get('/hapus_meta_diklat/{Kode_mata_diklat}', [AdminController::class, 'hapus_meta_diklat']);
    Route::get('/tambah_meta_diklat', [AdminController::class, 'tambah_meta_diklat'])->name('tambah_meta_diklat');
    Route::post('/tambah_meta_diklat', [AdminController::class, 'tambah_meta_diklatt']);
    Route::put('/update_meta_diklat/{Kode_mata_diklat}', [AdminController::class, 'updateMetaDiklat'])->name('update_meta_diklat');
    Route::get('/kompetensi_keahlian', [AdminController::class, 'kompetensi_keahlian'])->name('kompetensi_keahlian');
    Route::get('/tambah_kompetensi_keahlian', [AdminController::class, 'tambah_kompetensi_keahlian'])->name('tambah_kompetensi_keahlian');
    Route::post('/tambah_kompetensi_keahlian', [AdminController::class, 'tambah_kompetensi_keahliann']);
    Route::get('/hapus_kompetensi_keahlian/{Kode_KK}', [AdminController::class, 'hapus_kompetensi_keahlian']);
    Route::put('/update_kompetensi_keahlian/{Kode_KK}', [AdminController::class, 'updateKompetensiKeahlian'])->name('update_kompetensi_keahlian');
    Route::get('/standar_kompetensi', [AdminController::class, 'standar_kompetensi'])->name('standar_kompetensi');
    Route::get('/hapus_standar_kompetensi/{Kode_SK}', [AdminController::class, 'hapus_standar_kompetensi']);
    Route::get('/tambah_standar_kompetensi', [AdminController::class, 'tambah_standar_kompetensi'])->name('tambah_standar_kompetensi');
    Route::post('/tambah_standar_kompetensi', [AdminController::class, 'tambah_standar_kompetensii']);
    Route::put('/update_standar_kompetensi/{Kode_SK}', [AdminController::class, 'updateStandarKompetensi'])->name('update_standar_kompetensi');
    Route::get('/data_pengguna_sistem', [AdminController::class, 'data_pengguna_sistem'])->name('data_pengguna_sistem');
    Route::get('/tambah_pengguna_sistem', [AdminController::class, 'tambah_pengguna_sistem'])->name('tambah_pengguna_sistem');
    Route::post('/tambah_pengguna_sistem', [AdminController::class, 'tambah_kompetensi_sistem_storage']);
    Route::get('/akun_saya', [AdminController::class, 'akun_saya'])->name('akun_saya');
    Route::get('/hapus_pengguna/{username}', [AdminController::class, 'hapus_pengguna']);
    Route::get('/logout_admin', [AuthController::class, 'logout']);
});

Route::middleware(['auth', 'guru'])->group(function () {
    Route::get('/dashboard_guru', [GuruController::class, 'dashboard_guru'])->name('dashboard_guru');
    Route::get('/logout_guru', [AuthController::class, 'logout_guru']);
});

Route::middleware(['auth', 'wali_murid'])->group(function () {
    Route::get('/dashboard_wali_murid', [WaliKelasController::class, 'dashboard_wali_murid'])->name('dashboard_wali_murid');
    Route::get('/logout_walimurid', [AuthController::class, 'logout_walimurid']);
});