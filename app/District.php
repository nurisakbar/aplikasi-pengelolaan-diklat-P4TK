<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public $timestamps = false;

    protected $fillable = ['id','name','regency_id'];

    public function regency()
    {
        return $this->belongsTo(\App\Regency::class);
    }
}
