<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KompetensiKeahlian extends Model
{
    protected $table = "kompetensi_keahlian";

    protected $fillable = ['nama_kompetensi_keahlian','program_keahlian_id'];
}
