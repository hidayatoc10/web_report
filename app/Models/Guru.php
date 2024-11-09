<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'guru';
    protected $guarded = ['id'];
    public function kompetensiKeahlian()
    {
        return $this->belongsTo(KopetensiKeahlian::class, 'Kode_KK', 'Kode_KK');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'Kode_guru', 'Kode_guru');
    }
}
