<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaDiklat extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function kompetensiKeahlian()
    {
        return $this->hasMany(KopetensiKeahlian::class, 'Kode_mata_diklat', 'Kode_mata_diklat');
    }

}
