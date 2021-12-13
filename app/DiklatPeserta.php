<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiklatPeserta extends Model
{
    protected $table = "diklat_peserta";

    protected $fillable = ['diklat_id','nopes','keterangan','status_kehadiran'];

    public function gtk()
    {
        return $this->belongsTo(\App\Gtk::class, 'nopes', 'nopes');
    }
}
