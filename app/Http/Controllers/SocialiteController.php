<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Gtk;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $gtk = Gtk::where('email', $user->email)->first();
        if ($gtk) {
            \Auth::guard('gtk')->loginUsingId($gtk->id);
            session(['avatar' => $user->avatar]);
            return redirect('/profile')->with('message', 'Selamat Datang ' . $gtk->nama_lengkap);
        } else {
            return redirect('/masuk')->with('failed', 'Email Anda Tidak Terdaftar');
        }
    }
}
