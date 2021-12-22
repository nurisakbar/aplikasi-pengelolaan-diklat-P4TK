<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiklatPeserta extends Model
{
    use SoftDeletes;

    protected $table = "diklat_peserta";

    protected $fillable = ['diklat_id','diklat_kelas_id','nopes','keterangan','status_kehadiran'];

    public function gtk()
    {
        return $this->belongsTo(\App\Gtk::class, 'nopes', 'nopes');
    }

    public function kelas()
    {
        return $this->belongsTo(\App\DiklatKelas::class, 'diklat_kelas_id', 'id');
    }
}
