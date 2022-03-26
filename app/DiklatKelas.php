<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiklatKelas extends Model
{
    protected $table = "diklat_kelas";

    protected $fillable = ['diklat_id','nama_kelas'];


    public function peserta()
    {
        return $this->hasMany('App\DiklatPeserta', 'diklat_kelas_id', 'id');
    }
}
