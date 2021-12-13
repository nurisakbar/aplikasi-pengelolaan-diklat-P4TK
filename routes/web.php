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

Route::get('/', function () {
    return redirect('login');
});
Auth::routes();
Route::get('user/dropdown-jabatan', 'UserController@dropdownJabatan');
Route::get('home', 'PageController@home');
Route::resource('gtk', 'GtkController');
Route::resource('diklat', 'DIklatController');
Route::resource('user', 'UserController');
