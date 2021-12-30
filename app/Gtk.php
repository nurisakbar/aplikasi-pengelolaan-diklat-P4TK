<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gtk extends Model
{
    protected $primaryKey = "id";
  
    protected $table = "gtk";

    protected $guarded = ['id'];

  
    public function instansi()
    {
        return $this->belongsTo(\App\Instansi::class, 'instansi_id', 'id');
    }

    public function village()
    {
        return $this->belongsTo(Village::class);

    }
}
