<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Foundation\Auth\Gtk as Authenticatable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Gtk extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = "id";

    protected $table = "gtk";

    protected $guarded = ['id'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function instansi()
    {
        return $this->belongsTo(\App\Instansi::class, 'instansi_id', 'id');
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    protected $casts = [
        'nomor_ukg' => 'string'
     ];
}
