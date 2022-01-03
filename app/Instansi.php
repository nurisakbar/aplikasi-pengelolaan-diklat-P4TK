<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $table = "instansi";

    protected $guarded = ['id'];

    // public function district()
    // {
    //     return $this->belongsTo(\App\District::class);
    // }

    public function wilayahAdministratif()
    {
        return $this->belongsTo(\App\WilayahAdministratif::class, 'district_id', 'district_id');
    }
}
