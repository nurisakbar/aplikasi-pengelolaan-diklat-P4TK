<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Gtk;

class Diklat extends Model
{
    protected $table = "diklat";

    protected $fillable = ['nama_diklat','tahun','status_aktif'];

    public function peserta()
    {
        return $this->hasMany(DiklatPeserta::class);
    }
}
