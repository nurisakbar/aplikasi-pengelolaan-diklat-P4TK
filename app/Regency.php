<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    protected $fillable = ['name','province_id','id'];

    public $timestamps = false;

    public function province()
    {
        return $this->belongsTo(\App\Province::class);
    }
}
