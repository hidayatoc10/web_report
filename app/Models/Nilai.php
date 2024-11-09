<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'NISN', 'NISN');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'Kode_guru', 'Kode_guru');
    }

    public function standarKompetensi()
    {
        return $this->belongsTo(StandarKopetensi::class, 'Kode_SK', 'Kode_SK');
    }

}