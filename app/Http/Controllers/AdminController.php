<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\KopetensiKeahlian;
use App\Models\MetaDiklat;
use App\Models\Siswa;
use App\Models\User;
use App\Models\StandarKopetensi;
use App\Models\WaliMurid;
use Illuminate\Http\Request;
use Storage;

class AdminController extends Controller
{
    public function dashboard_admin()
    {
        $jumlah_user = User::count();
        $jumlah_guru = Guru::count();
        $jumlah_kompetisikeahlian = KopetensiKeahlian::count();
        return view("admin.dashboard_admin", [
            "jumlah_user" => $jumlah_user,
            "kompetisi" => $jumlah_kompetisikeahlian,
            'guru' => $jumlah_guru,
        ]);
    }

    public function data_siswa()
    {
        $data = Siswa::orderBy('created_at', 'desc')->get();
        return view("admin.data_siswa.data_siswa", [
            "data" => $data,
        ]);
    }
    public function tambah_siswa()
    {
        return view("admin.data_siswa.tambah_siswa");
    }

    public function storeSiswa(Request $request)
    {
        $request->validate([
            'nisn' => 'required|unique:siswas,NISN|size:10',
            'kode_kk' => 'required|size:10',
            'nama' => 'required|max:50|min:3',
            'alamat' => 'required|max:100',
            'tanggal_lahir' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:3000'
        ]);
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_siswa', 'public');
        }
        Siswa::create([
            'NISN' => $request->nisn,
            'Kode_KK' => $request->kode_kk,
            'Nama_siswa' => $request->nama,
            'Alamat_siswa' => $request->alamat,
            'Tgl_lahir' => $request->tanggal_lahir,
            'Foto_siswa' => $fotoPath
        ]);

        return redirect()->route('data_siswa')->with('berhasil_ditambah_siswa', 'Data siswa berhasil ditambahkan');
    }

    public function hapus_siswa($NISN)
    {
        $data = Siswa::where('NISN', $NISN)->first();
        if (!$data) {
            return redirect()->route('data_siswa')->with('dataganemu', 'Data siswa tidak ditemukan');
        } else {
            $data->delete();
            return redirect()->route('data_siswa')->with('dihapus', 'Data siswa berhasil dihapus');
        }
    }

    public function updateSiswa(Request $request, $NISN)
    {
        $request->validate([
            'nisn' => 'required|size:10',
            'kode_kk' => 'required|size:10',
            'nama' => 'required|max:50|min:3',
            'alamat' => 'required|max:100',
            'tanggal_lahir' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:3000'
        ]);

        $siswa = Siswa::where('NISN', $NISN)->firstOrFail();

        if ($request->hasFile('foto')) {
            if ($siswa->Foto_siswa) {
                Storage::disk('public')->delete($siswa->Foto_siswa);
            }
            $siswa->Foto_siswa = $request->file('foto')->store('foto_siswa', 'public');
        }

        $siswa->NISN = $request->nisn;
        $siswa->Kode_KK = $request->kode_kk;
        $siswa->Nama_siswa = $request->nama;
        $siswa->Alamat_siswa = $request->alamat;
        $siswa->Tgl_lahir = $request->tanggal_lahir;
        $siswa->save();

        return redirect()->route('data_siswa')->with('berhasil_diupdate', 'Data siswa berhasil diupdate');
    }


    public function data_wali_murid()
    {
        $data = WaliMurid::orderBy('created_at', 'desc')->get();
        return view('admin.datawali.data_wali_murid', [
            'datawali' => $data,
        ]);
    }

    public function tambah_wali()
    {
        $data = Siswa::orderBy('created_at', 'desc')->get();
        return view('admin.datawali.tambah_wali', [
            'siswa' => $data,
        ]);
    }
    public function storeWali(Request $request)
    {
        $validatedData = $request->validate([
            'Kode_wali' => 'required|string|max:10|unique:wali_murids,Kode_wali|min:5',
            'NISN' => 'required|exists:siswas,NISN',
            'Nama_ayah' => 'required|string|max:50|min:3',
            'Pekerjaan_ayah' => 'nullable|string|max:100|min:3',
            'Nama_ibu' => 'required|string|max:50|min:3',
            'Pekerjaan_ibu' => 'nullable|string|max:100|min:3',
            'Alamat_wali' => 'required|string|max:200|min:10',
            'Telp_wali' => 'nullable|max:15|min:10',
        ]);

        WaliMurid::create([
            'Kode_wali' => $request->Kode_wali,
            'NISN' => $request->NISN,
            'Nama_ayah' => $request->Nama_ayah,
            'Pekerjaan_ayah' => $request->Pekerjaan_ayah,
            'Nama_ibu' => $request->Nama_ibu,
            'Pekerjaan_ibu' => $request->Pekerjaan_ibu,
            'Alamat_wali' => $request->Alamat_wali,
            'Telp_wali' => $request->Telp_wali,
        ]);

        return redirect()->route('data_wali_murid')->with('success', 'Data wali murid berhasil ditambahkan.');
    }

    public function hapus_wali($Kode_wali)
    {
        $data = WaliMurid::where('Kode_wali', $Kode_wali)->first();
        if (!$data) {
            return redirect()->route('data_wali_murid')->with('dataganemu', 'Data siswa tidak ditemukan');
        } else {
            $data->delete();
            return redirect()->route('data_wali_murid')->with('dihapus', 'Data siswa berhasil dihapus');
        }
    }
    public function editWali($Kode_wali)
    {
        $waliMurid = WaliMurid::where('Kode_wali', $Kode_wali)->first();
        $siswas = Siswa::orderBy('Nama_siswa', 'asc')->get();
        return response()->json(['wali' => $waliMurid, 'siswas' => $siswas]);
    }

    public function updateWali(Request $request, $Kode_wali)
    {
        $validatedData = $request->validate([
            'Kode_wali' => 'required|string|max:10|unique:wali_murids,Kode_wali|min:5',
            'NISN' => 'required|exists:siswas,NISN',
            'Nama_ayah' => 'required|string|max:50|min:3',
            'Pekerjaan_ayah' => 'nullable|string|max:100|min:3',
            'Nama_ibu' => 'required|string|max:50|min:3',
            'Pekerjaan_ibu' => 'nullable|string|max:100|min:3',
            'Alamat_wali' => 'required|string|max:200|min:10',
            'Telp_wali' => 'nullable|max:15|min:10',
        ]);

        $waliMurid = WaliMurid::where('Kode_wali', $Kode_wali)->first();
        $waliMurid->update($validatedData);

        return redirect()->route('data_wali_murid')->with('berhasil_diupdate', 'Data wali murid berhasil diperbarui.');
    }

    public function data_guru()
    {
        $data = Guru::orderBy('created_at', 'desc')->get();
        $kompetensiKeahlian = KopetensiKeahlian::orderBy('created_at', 'desc')->get();

        return view('admin.guru.data_guru', [
            'data' => $data,
            'kompetensiKeahlian' => $kompetensiKeahlian,
        ]);
    }


    public function tambah_guru()
    {
        $data = KopetensiKeahlian::orderBy('created_at', direction: 'desc')->get();
        return view('admin.guru.tambah_guru', [
            'siswa' => $data,
        ]);
    }

    public function tambah_guru_storage(Request $request)
    {
        $validator = $request->validate([
            'Kode_guru' => ['required', 'min:5', 'max:10', 'unique:guru'],
            'Kode_KK' => ['required', 'min:5', 'max:10'],
            'Nama_guru' => ['required', 'min:3', 'max:50'],
            'NIP' => ['required', 'min:6', 'max:17'],
            'Alamat_guru' => ['required', 'min:10', 'max:100'],
            'Telp_guru' => ['required', 'min:9', 'max:11'],
        ]);

        Guru::create([
            'Kode_guru' => $request->Kode_guru,
            'Kode_KK' => $request->Kode_KK,
            'Nama_guru' => $request->Nama_guru,
            'NIP' => $request->NIP,
            'Alamat_guru' => $request->Alamat_guru,
            'Telp_guru' => $request->Telp_guru,
        ]);

        return redirect()->route('data_guru')->with('success', 'berhasil');
    }

    public function hapus_guru(Request $request, $Kode_guru)
    {
        $data = Guru::where('Kode_guru', $Kode_guru)->first();
        if (!$data) {
            return redirect()->route('data_guru')->with('dataganemu', 'Data siswa tidak ditemukan');
        } else {
            $data->delete();
            return redirect()->route('data_guru')->with('dihapus', 'Data siswa berhasil dihapus');
        }
    }

    public function updateGuru(Request $request, $Kode_guru)
    {
        $validated = $request->validate([
            'Kode_guru' => ['required', 'min:5', 'max:10'],
            'Kode_KK' => ['required', 'min:5', 'max:10'],
            'Nama_guru' => ['required', 'min:3', 'max:50'],
            'NIP' => ['required', 'min:6', 'max:17'],
            'Alamat_guru' => ['required', 'min:10', 'max:100'],
            'Telp_guru' => ['required', 'min:9', 'max:15'],
        ]);

        $guru = Guru::where('Kode_guru', $Kode_guru)->first();
        if (!$guru) {
            return redirect()->route('data_guru')->with('dataganemu', 'Data guru tidak ditemukan');
        }
        $guru->update([
            'Kode_guru' => $request->Kode_guru,
            'Nama_guru' => $request->Nama_guru,
            'NIP' => $request->NIP,
            'Alamat_guru' => $request->Alamat_guru,
            'Telp_guru' => $request->Telp_guru,
            'Kode_KK' => $request->Kode_KK,
        ]);
        return redirect()->route('data_guru')->with('berhasil_diupdate', 'Data guru berhasil diperbarui');
    }

    public function data_meta_diklat()
    {
        $data = MetaDiklat::orderBy('created_at', 'desc')->get();
        return view('admin.meta_diklat.data_meta_diklat', [
            'data' => $data,
        ]);
    }
    public function hapus_meta_diklat($Kode_mata_diklat)
    {
        $data = MetaDiklat::where('Kode_mata_diklat', $Kode_mata_diklat)->first();
        if (!$data) {
            return redirect()->route('data_meta_diklat')->with('dataganemu', 'Data siswa tidak ditemukan');
        } else {
            $data->delete();
            return redirect()->route('data_meta_diklat')->with('dihapus', 'Data siswa berhasil dihapus');
        }
    }

    public function tambah_meta_diklat()
    {
        return view('admin.meta_diklat.tambah_meta_diklat');
    }

    public function tambah_meta_diklatt(Request $request)
    {
        $validated = $request->validate([
            'Kode_mata_diklat' => ['required', 'min:5', 'max:10'],
            'Nama_mata_diklat' => ['required', 'min:3', 'max:50'],
        ]);

        MetaDiklat::create([
            'Kode_mata_diklat' => $request->Kode_mata_diklat,
            'Nama_mata_diklat' => $request->Nama_mata_diklat,
        ]);

        return redirect()->route('data_meta_diklat')->with('success', 'berhasil');
    }

    public function updateMetaDiklat(Request $request, $Kode_mata_diklat)
    {
        $validated = $request->validate([
            'Kode_mata_diklat' => ['required', 'min:5', 'max:10'],
            'Nama_mata_diklat' => ['required', 'min:3', 'max:50'],
        ]);

        $guru = MetaDiklat::where('Kode_mata_diklat', $Kode_mata_diklat)->first();
        if (!$guru) {
            return redirect()->route('data_meta_diklat')->with('dataganemu', 'Data guru tidak ditemukan');
        }
        $coba = $guru->update([
            'Kode_mata_diklat' => $request->Kode_mata_diklat,
            'Nama_mata_diklat' => $request->Nama_mata_diklat,
        ]);

        if (!$coba) {
            return redirect()->route('data_meta_diklat')->with('datagagal', 'gagal');
        } else {
            return redirect()->route('data_meta_diklat')->with('berhasil_diupdate', 'Data guru berhasil diperbarui');
        }
    }

    public function kompetensi_keahlian()
    {
        $data = KopetensiKeahlian::orderBy('created_at', 'desc')->get();
        $metaDiklat = MetaDiklat::all();
        return view('admin.kompetensi_keahlian.kompetensi_keahlian', [
            'data' => $data,
            'metaDiklat' => $metaDiklat,
        ]);
    }

    public function tambah_kompetensi_keahlian()
    {
        $data = MetaDiklat::orderBy('created_at', 'desc')->get();
        return view('admin.kompetensi_keahlian.tambah_kompetensi_keahlian', [
            'siswa' => $data,
        ]);
    }
    public function tambah_kompetensi_keahliann(Request $request)
    {
        $validated = $request->validate([
            'Kode_KK' => ['required', 'min:5', 'max:10'],
            'Kode_mata_diklat' => ['required', 'min:5', 'max:10'],
            'Nama_kompetensi_keahlian' => ['required', 'min:3', 'max:50'],
        ]);

        KopetensiKeahlian::create([
            'Kode_KK' => $request->Kode_KK,
            'Kode_mata_diklat' => $request->Kode_mata_diklat,
            'Nama_kompetensi_keahlian' => $request->Nama_kompetensi_keahlian,
        ]);

        return redirect()->route('kompetensi_keahlian')->with('success', 'berhasil');
    }

    public function hapus_kompetensi_keahlian($Kode_KK)
    {
        $data = KopetensiKeahlian::where('Kode_KK', $Kode_KK)->first();
        if (!$data) {
            return redirect()->route('kompetensi_keahlian')->with('dataganemu', 'Data siswa tidak ditemukan');
        } else {
            $data->delete();
            return redirect()->route('kompetensi_keahlian')->with('dihapus', 'Data siswa berhasil dihapus');
        }
    }
    public function updateKompetensiKeahlian(Request $request, $Kode_KK)
    {
        $validated = $request->validate([
            'Kode_mata_diklat' => ['required', 'min:5', 'max:10'],
            'Nama_kompetensi_keahlian' => ['required', 'min:3', 'max:50'],
        ]);
        $kompetensiKeahlian = KopetensiKeahlian::where('Kode_KK', $Kode_KK)->first();
        if (!$kompetensiKeahlian) {
            return redirect()->route('kompetensi_keahlian')->with('dataganemu', 'Data Kompetensi Keahlian tidak ditemukan');
        }
        $kompetensiKeahlian->Kode_mata_diklat = $request->Kode_mata_diklat;
        $kompetensiKeahlian->Nama_kompetensi_keahlian = $request->Nama_kompetensi_keahlian;
        $kompetensiKeahlian->save();

        return redirect()->route('kompetensi_keahlian')->with('berhasil_diupdate', 'Data Kompetensi Keahlian berhasil diperbarui');
    }

    public function standar_kompetensi()
    {
        $data = StandarKopetensi::orderBy('created_at', 'asc')->get();
        $kompetensiKeahlian = KopetensiKeahlian::all();
        return view('admin.standar_kompetensi.data_standar_kompetensi', [
            'data' => $data,
            'kompetensiKeahlian' => $kompetensiKeahlian,
        ]);
    }


    public function hapus_standar_kompetensi($Kode_SK)
    {
        $data = StandarKopetensi::where('Kode_SK', $Kode_SK)->first();
        if (!$data) {
            return redirect()->route('standar_kompetensi')->with('dataganemu', 'Data siswa tidak ditemukan');
        } else {
            $data->delete();
            return redirect()->route('standar_kompetensi')->with('dihapus', 'Data siswa berhasil dihapus');
        }
    }

    public function tambah_standar_kompetensi()
    {
        $data = KopetensiKeahlian::orderBy('created_at', 'desc')->get();
        return view('admin.standar_kompetensi.tambah_standar_kompetensi', [
            'data' => $data,
        ]);
    }

    public function tambah_standar_kompetensii(Request $request)
    {
        $validated = $request->validate([
            'Kode_SK' => ['required', 'min:5', 'max:10'],
            'Kode_KK' => ['required', 'min:3', 'max:10'],
            'Nama_SK' => ['required', 'min:3', 'max:50'],
            'Kelas_SK' => ['required', 'min:3', 'max:10'],
        ]);

        StandarKopetensi::create([
            'Kode_SK' => $request->Kode_SK,
            'Kode_KK' => $request->Kode_KK,
            'Nama_SK' => $request->Nama_SK,
            'Kelas_SK' => $request->Kelas_SK,
        ]);

        return redirect()->route('standar_kompetensi')->with('success', 'berhasil');
    }
    public function updateStandarKompetensi(Request $request, $Kode_SK)
    {
        $validated = $request->validate([
            'Kode_SK' => 'required|unique:standar_kopetensis,Kode_SK,' . $Kode_SK . '|max:10',
            'Kode_KK' => 'required|exists:kopetensi_keahlians,Kode_KK',
            'Nama_SK' => 'required|max:50',
            'Kelas_SK' => 'required|max:10',
        ]);

        $standarKompetensi = StandarKopetensi::where('Kode_SK', $Kode_SK)->first();

        $standarKompetensi->update([
            'Kode_SK' => $validated['Kode_SK'],
            'Kode_KK' => $validated['Kode_KK'],
            'Nama_SK' => $validated['Nama_SK'],
            'Kelas_SK' => $validated['Kelas_SK'],
        ]);

        return redirect()->route('standar_kompetensi')->with('berhasil_diupdate', 'Data Standar Kompetensi berhasil diperbarui');
    }

    public function data_pengguna_sistem()
    {
        $data = User::orderBy('created_at', 'desc')->get();
        return view('admin.pengguna_sistem.data_pengguna_sistem', [
            'data' => $data
        ]);
    }

    public function tambah_pengguna_sistem()
    {
        return view('admin.pengguna_sistem.tambah_pengguna_sistem');
    }

    public function tambah_kompetensi_sistem_storage(Request $request)
    {
        $validated = $request->validate([
            "name" => ["required", "string", "min:3", "max:50"],
            "username" => ["required", "min:3", "max:50", "unique:users,username"],
            "email" => ["required", "min:4", "max:100", "email", "unique:users,email"],
            "password" => ["required", "min:7", "max:100"],
            "keterangan" => ["required", "min:3", "max:50"],
        ]);

        User::create([
            "name" => $request->name,
            "username" => $request->username,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "keterangan" => $request->keterangan,
        ]);

        return redirect()->route("data_pengguna_sistem")->with("success", "berhasil");
    }
    public function hapus_pengguna($username)
    {
        $data = User::where('username', $username)->first();
        if (!$data) {
            return redirect()->route('data_pengguna_sistem')->with('dataganemu', 'Data siswa tidak ditemukan');
        } else {
            $data->delete();
            return redirect()->route('data_pengguna_sistem')->with('dihapus', 'Data siswa berhasil dihapus');
        }
    }
    public function akun_saya()
    {
        return view('admin.akun_saya.akun_saya');
    }
}