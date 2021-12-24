<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KompetensiKeahlian extends Model
{
    protected $table = "kompetensi_keahlian";

    protected $fillable = ['nama_kompetensi_keahlian','program_keahlian_id'];


    public function programKeahlian()
    {
        return $this->belongsTo(\App\ProgramKeahlian::class, 'program_keahlian_id', 'id');
    }
}
