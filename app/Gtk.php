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

    public function kompetensiKeahlian()
    {
        return $this->belongsTo(KompetensiKeahlian::class);
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    protected $casts = [
        'nomor_ukg' => 'string'
     ];


     protected $appends = ['umur'];


    public function getUmurAttribute()
    {
        return \Carbon\Carbon::parse($this->tanggal_lahir)->diff(\Carbon\Carbon::now())->format('%y') . ' Tahun';
    }
}
