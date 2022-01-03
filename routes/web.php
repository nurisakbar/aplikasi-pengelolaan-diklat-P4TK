<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PageController@home');
Route::get('dashboard', 'PageController@dashboard');
Auth::routes();
Route::get('user/dropdown-jabatan', 'UserController@dropdownJabatan');
Route::get('/ajax/kabupaten', 'AjaxController@kabupatenDropdown');
Route::get('home', 'PageController@home');
Route::resource('gtk', 'GtkController');
Route::get('diklat/{id}/export', 'DiklatController@export');
Route::post('diklat/import', 'DiklatController@importRiwayatDiklat');
Route::resource('diklat', 'DiklatController');
Route::resource('diklatpeserta', 'DiklatPesertaController');
Route::resource('user', 'UserController');
Route::resource('instansi', 'InstansiController');
Route::resource('kategori', 'KategoriDiklatController');
Route::resource('bidangkeahlian', 'BidangKeahlianController');
Route::resource('programkeahlian', 'ProgramKeahlianController');
Route::resource('kompetensikeahlian', 'KompetensiKeahlianController');
Route::resource('departemen', 'DepartemenController');
Route::post('tambah-kelas-diklat', 'DiklatController@tambahKelasDiklat');
Route::get('logout', 'LogoutController');

Route::get('/ajax/programkeahlian-dropdown', 'AjaxController@programKeahlianDropdown');
Route::get('/ajax/select2Desa', 'AjaxController@select2Desa');
Route::get('/ajax/select2Instansi', 'AjaxController@select2Instansi');

Route::get('/pendaftaran', 'PageController@pendaftaran');
Route::post('/pendaftaran/create', 'PageController@store');
Route::get('/masuk', 'PageController@masuk');
Route::get('daftarApprove', 'PageController@approve');
Route::post('daftarApprove/{id}', 'PageController@doApprove');
Route::get('daftarApprove/{id}', 'PageController@showApprove');
Route::get('/ajax/select2Daerah', 'AjaxController@select2Daerah');
Route::get('/pendaftaran','pageController@pendaftaran');
Route::get('/masuk','pageController@masuk');
