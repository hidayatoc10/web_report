<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KopetensiKeahlian extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function mataDiklat()
    {
        return $this->belongsTo(MetaDiklat::class, 'Kode_mata_diklat', 'Kode_mata_diklat');
    }

    public function standarKompetensi()
    {
        return $this->hasMany(StandarKopetensi::class, 'Kode_KK', 'Kode_KK');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'Kode_KK', 'Kode_KK');
    }

    public function guru()
    {
        return $this->hasMany(Guru::class, 'Kode_KK', 'Kode_KK');
    }
}