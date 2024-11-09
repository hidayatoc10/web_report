<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    public function waliMurid()
    {
        return $this->hasOne(WaliMurid::class, 'NISN', 'NISN');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'NISN', 'NISN');
    }

    public function kompetensiKeahlian()
    {
        return $this->belongsTo(KopetensiKeahlian::class, 'Kode_KK', 'Kode_KK');
    }

}
