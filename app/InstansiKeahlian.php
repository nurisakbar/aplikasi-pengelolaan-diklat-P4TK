<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstansiKeahlian extends Model
{
    protected $table = 'instansi_keahlian';

    protected $fillable = ['instansi_id','kompetensi_keahlian_id'];

    public function kompetensiKeahlian()
    {
        return $this->belongsTo(\App\KompetensiKeahlian::class);
    }
}
