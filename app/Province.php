<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['name','id'];

    public $timestamps = false;
}
