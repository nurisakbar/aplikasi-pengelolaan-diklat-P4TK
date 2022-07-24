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


     protected $appends = ['umur','is_profile_complate'];


    public function getUmurAttribute()
    {
        return \Carbon\Carbon::parse($this->tanggal_lahir)->diff(\Carbon\Carbon::now())->format('%y') . ' Tahun';
    }

    public function getIsProfileComplateAttribute()
    {
        $profileNull = [];

        if ($this->tempat_lahir == null) {
            $profileNull[] = 'Tempat Lahir Masih Kosong';
        }

        if ($this->jenis_kelamin == null) {
            $profileNull[] = 'Jenis Kelamin Masih Belum Terpilih';
        }

        if ($this->nip == null) {
            $profileNull[] = 'NIP Masih Kosong';
        }

        // if ($this->npwp == null) {
        //     $profileNull[] = 'NPWP Masih Belum Terpilih';
        // }

        if ($this->nuptk == null) {
            $profileNull[] = 'NUPTK Masih Belum Terpilih';
        }


        if ($this->jabatan == null) {
            $profileNull[] = 'Jabatan Masih Kosong';
        }

        if ($this->agama == null) {
            $profileNull[] = 'Agama Masih Belum Terpilih';
        }


        if ($this->jurusan_pendidikan_terakhir == null) {
            $profileNull[] = 'Jurusan Pendidikan Terkahir Masih Kosong';
        }

        if ($this->domisi_alamat_jalan == null) {
            $profileNull[] = 'Domisili Alamat Jalan Masih Koson';
        }

        if ($this->domisili_nama_dusun == null) {
            $profileNull[] = 'Domisili Alamat Dusun Masih Koson';
        }

        if ($this->golongan == null) {
            $profileNull[] = 'Golongan masih belum terpilih';
        }

        if ($this->village_id == null) {
            $profileNull[] = 'Alamat Desa Masih Belum Terpilih';
        }




        return $profileNull;
    }
}
