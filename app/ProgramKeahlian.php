<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramKeahlian extends Model
{
    protected $table = "program_keahlian";

    protected $fillable = ['nama_program_keahlian','bidang_keahlian_id'];
}
