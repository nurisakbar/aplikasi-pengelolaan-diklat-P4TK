<?php

use Spatie\Permission\Models\Role;

function hitung_absensi($user_id, $periode_awal, $periode_akhir, $status_kehadiran)
{
    $absensi = \App\Absensi::where('user_id', $user_id)
        ->where('status_kehadiran', $status_kehadiran)
        ->whereBetween('tanggal', [$periode_awal, $periode_akhir])
        ->count();
    return $absensi;
}


function lama_kerja($from, $to)
{
    $to = \Carbon\Carbon::createFromFormat('Y-m-d', $to);
    $from = \Carbon\Carbon::createFromFormat('Y-m-d', $from);
    return $to->diffInMonths($from);
}

function rupiah($value)
{
    return number_format($value, 0, ',', '.');
}


/// Helper Laporan Gaji


function hitungBonusByProfit($profit)
{
    $settingBonus = \App\SettingBonus::all();
    $persenBonus = 0;
    foreach ($settingBonus as $bonus) {
        if ($profit >= $bonus->dari && $profit <= $bonus->sampai) {
            $persenBonus = $bonus->bonus;
        }
    }

    return ($persenBonus / 100) * $profit;
}


function laporan_gaji_bonus($row)
{
    $bonus = \DB::select("select sum(jumlah_komisi) as profit_sebulan from penjualan
                where left(tanggal,7)='" . $row->periode_gaji . "' and user_id=" . $row->user_id);
    $profitSebulan = $bonus['0']->profit_sebulan ?? 0;
    // check setting bonus
    $settingBonus = \App\SettingBonus::all();
    $persenBonus = 0;
    foreach ($settingBonus as $bonus) {
        if ($profitSebulan >= $bonus->dari && $profitSebulan <= $bonus->sampai) {
            $persenBonus = $bonus->bonus;
        }
    }

    return ($persenBonus / 100) * $profitSebulan;
}

function laporan_gaji_tunjangan_jabatan($row)
{
    return $row->user->jabatan->tunjangan ?? 0;
}

function laporan_gaji_gaji_pokok($row)
{
    $jml_hadir  = hitung_absensi($row->user_id, $row->periode_gaji . '-01', $row->periode_gaji . '-31', 'h');
    $lama_kerja = lama_kerja($row->user->tanggal_mulai_bekerja, $row->periode_gaji . '-01');
    if ($lama_kerja < 3) {
        $settingGajiPokok = \App\SettingGajiPokok::where('id', 1)->first();
    } else {
        $settingGajiPokok = \App\SettingGajiPokok::where('id', 2)->first();
    }

    return $settingGajiPokok->jumlah * $jml_hadir;
}

function hitung_umur($date)
{
    $sekarang      = Carbon\Carbon::now();
    $tanggal_lahir = Carbon\Carbon::parse($date);
    $umur = $tanggal_lahir->diffInYears($sekarang);

    return $umur;
}

function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}


function check_access($role_id, $permission)
{
    $role = Role::findById($role_id);

    if ($role->hasPermissionTo($permission)) {
        return 'checked';
    }
}


function send_wa($receive, $text)
{
    $token = "zZ63YDMvbO2x2AWvc5dmfYgswtwEADBn84zgDnVfdtmlEmTXj0N8rtNfyHQuDH1d";
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://solo.wablas.com/api/v2/send-message',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => '{
        "data": [
            {
                "phone": "' . $receive . '",
                "message": "' . $text . '" ,
                "secret": false,
                "retry": false,
                "isGroup": false
            }
        ]
    }',
    CURLOPT_HTTPHEADER => array(
        'Authorization: zZ63YDMvbO2x2AWvc5dmfYgswtwEADBn84zgDnVfdtmlEmTXj0N8rtNfyHQuDH1d',
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
}
