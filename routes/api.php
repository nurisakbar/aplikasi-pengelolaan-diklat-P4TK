<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('diklat','Api\DiklatController');
Route::get('grafik','Api\DiklatController@test');
Route::get('info-umum','Api\ApiController@infoUmum');
Route::get('jumlah-peserta-diklat-pertahun','Api\ApiController@jumlahPesertaDiklatPertahun');
Route::get('jumlah-peserta-perprovinsi','Api\ApiController@jumlahPesertaDiklatPerProvince');
