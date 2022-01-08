<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Auth;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (Auth::guard('gtk')->check()) {
            Auth::guard('gtk')->logout();
            return redirect('/masuk')->with('message', 'Anda Sudah Berhasil Logout');
        }

        Auth::logout();
        $request->session()->forget('avatar');
        return redirect('/login')->with('message', 'Anda Sudah Berhasil Logout');
    }
}
