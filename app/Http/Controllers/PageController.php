<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }
    public function dashboard()
    {
        return view('dashboard');
    }

    public function diklatDetail(){

    }

    public function pendaftaran(){
        return view('pendaftaran');
    }


    public function masuk(){
        return view('masuk');
    }
}
