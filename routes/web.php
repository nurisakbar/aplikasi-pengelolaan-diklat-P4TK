<?php

use Illuminate\Support\Facades\Auth;
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
Route::get('diklat/kategori/{id}','PageController@diklatByCategory');
Route::get('dashboard', 'PageController@dashboard');
Auth::routes();
Route::get('user/dropdown-jabatan', 'UserController@dropdownJabatan');
Route::get('/ajax/kabupaten', 'AjaxController@kabupatenDropdown');
Route::get('home', 'PageController@home');
Route::resource('gtk', 'GtkController');
Route::get('diklat/laporan-peserta-diklat','DiklatController@laporanPesertaDiklat');
Route::post('laporan-peserta-diklat-excel','DiklatController@laporanPesertaDiklatExcel');
Route::get('diklat/{id}/export', 'DiklatController@export');
Route::post('diklat/import-diklat','DiklatController@importDiklat');
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
Route::resource('role', 'RoleController');
Route::resource('permission', 'PermissionController');
Route::post('changePermission', 'RoleController@changePermission');
Route::post('tambah-kelas-diklat', 'DiklatController@tambahKelasDiklat');
Route::get('logout', 'LogoutController');
Route::get('list-diklat', 'AccessGtkController@index');
Route::get('profile', 'AccessGtkController@profile');
Route::put('updateProfile/{id}', 'AccessGtkController@updateProfile');
Route::get('detailDiklat/{id}', 'AccessGtkController@detailDiklat');

Route::get('/ajax/programkeahlian-dropdown', 'AjaxController@programKeahlianDropdown');
Route::get('/ajax/bidangkeakhlian-dropdown', 'AjaxController@bidangKeahlianDropdown');
Route::get('/ajax/kompetensikeakhlian-dropdown', 'AjaxController@kompetensiKeahlianDropdown');
Route::get('/ajax/select2Desa', 'AjaxController@select2Desa');
Route::get('/ajax/select2Instansi', 'AjaxController@select2Instansi');
Route::get('/ajax/select2KompetensiKeahlian','AjaxController@select2KompetensiKeahlian');


Route::resource('kelas-diklat','DiklatKelasController');
Route::get('/pendaftaran', 'PageController@pendaftaran');
Route::post('/pendaftaran/create', 'PageController@store');
Route::post('/verifikasi-email', 'PageController@verifikasiEmail');
Route::get('/masuk', 'PageController@masuk');
Route::get('daftarApprove', 'GtkController@approve');
Route::post('daftarApprove/{id}', 'GtkController@doApprove');
Route::get('deleteApprove/{id}', 'GtkController@DeleteApprove');
Route::get('daftarApprove/{id}', 'GtkController@showApprove');
Route::get('/ajax/select2Daerah', 'AjaxController@select2Daerah');
Route::get('/pendaftaran', 'PageController@pendaftaran');
Route::get('/masuk', 'PageController@masuk');
Route::get('/lupa-password', 'PageController@lupaPassword');
Route::post('/lupa-password', 'PageController@lupaPasswordAct');
Route::post('login/gtk', 'PageController@doLogin')->name('login.gtk');

Route::get('/reload-captcha', 'PageController@reloadCaptcha');

Route::get('socialite/redirect','SocialiteController@redirect');
Route::get('socialite/callback','SocialiteController@callback');
Route::get('diklat/detail/{slug}','PageController@diklatDetail');
Route::get('ajax/daftar-diklat-mandiri','AjaxController@daftarDiklatMandiri');
Route::get('logout','PageController@logout');
Route::get('profile/diklatsaya','PageController@profileDiklatsaya');

