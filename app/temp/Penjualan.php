<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = "penjualan";

    protected $fillable = [
        'toko_id',
        'user_id',
        'tanggal',
        'nomor_pesanan',
        'nama_pembeli',
        'supplier',
        'ongkir_customer',
        'ongkir_supplier',
        'akun_belanja',
        'uang_masuk',
        'nomor_hp',
        'status',
        'nomor_pesanan_beli_ke_supplier',
        'nomor_resi_sementara',
        'nomor_resi_asli',
        'status_wa',
        'catatan',
        'dana_cair',
        'uang_belanja_ke_supplier',
        'total_refund',
        'total_piutang',
        'total_rugi',
        'profit',
        'jumlah_komisi'
    ];


    public function toko()
    {
        return $this->belongsTo(\App\Toko::class);
    }

    // public function setProfitAttribute($value)
    // {
    //     $this->attributes['profit'] = 100000000;
    // }


    // protected $appends = ['profit','komisi'];

    // public function getProfitAttribute()
    // {
    //     return 0.01 * $this->uang_masuk;
    // }

    // public function getKomisiAttribute()
    // {
    //     if($this->status == 'Refund')
    //     {
    //         $komisi = (($this->uang_masuk - $this->total_refund) + $this->ongkir_customer) - ($this->uang_belanja_ke_supplier + $this->ongkir_supplier + (0.01 * $this->uang_masuk));
    //     }elseif($this->status == 'Piutang')
    //     {
    //         $komisi = (($this->uang_masuk - $this->total_piutang) + $this->ongkir_customer) - ($this->uang_belanja_ke_supplier + $this->ongkir_supplier + (0.01 * $this->uang_masuk));
    //     }elseif($this->status == 'Rugi')
    //     {
    //         //$komisi = (($this->uang_masuk - $this->total_rugi) + $this->ongkir_customer) - ($this->uang_belanja_ke_supplier + $this->ongkir_supplier + (0.01 * $this->uang_masuk));
    //         $komisi  =1;
    //     }else{
    //         $komisi = ($this->uang_masuk + $this->ongkir_customer) - ($this->uang_belanja_ke_supplier + $this->ongkir_supplier + (0.01 * $this->uang_masuk));
    //     }

    //     \DB::table('penjualan')->where('id', $this->id)->update(['jumlah_komisi' => $komisi]);
    //     \DB::table('penjualan')->where('id', $this->id)->update(['profit' => $komisi]);
    //     \Log::info($komisi);
    //     return $komisi;
    // }
}
