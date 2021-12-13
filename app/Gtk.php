<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gtk extends Model
{
    protected $table = "master_gtk";

    protected $fillable = ['nama_jabatan','level','jabatan_id','tunjangan'];


    // public function jabatan()
    // {
    //     return $this->belongsTo(\App\Jabatan::class);
    // }
}
