<?php

namespace App\Http\Controllers;

use App\Gtk;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PendaftaranCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Diklat;
use Mail;
use App\BidangKeahlian;
use App\DiklatPeserta;
use App\VerifikasiEmail;
use App\Instansi;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['dashboard']);
    }
    public function home(Request $request)
    {
        $diklat = Diklat::with('programKeahlian', 'kategori');
        if ($request->has('search')) {
            $diklat->where('nama_diklat', 'like', "%" . $request->search . "%");
        }
        $data['diklat'] = $diklat->paginate(9);
        return view('home', $data);
    }

    public function diklatByCategory($id)
    {
        $data['bidangKeahlian'] = BidangKeahlian::findOrFail($id);
        $data['diklat'] = Diklat::where('bidang_keahlian_id', $id)->with('programKeahlian', 'kategori')->paginate(9);
        return view('diklat-berdasarkan-kategori', $data);
    }

    public function dashboard()
    {
        $data['jumlahDiklatAktif'] = Diklat::where('status_aktif', 'Aktif')->count();
        $data['jumlahGtk'] = Gtk::count();
        $data['jumlahInstansi'] = Instansi::count();
        return view('dashboard', $data);
    }

    public function pendaftaran(Request $request)
    {
        $token = $request->token;
        if ($token) {
            $verifikasiEmail = VerifikasiEmail::where('token', $token)->first();
            if (!$verifikasiEmail) {
                abort(404);
            }
            $data['verifikasi'] = $verifikasiEmail;
            return view('pendaftaran', $data);
        } else {
            return view('verifikasi-email');
        }
    }

    public function verifikasiEmail(Request $request)
    {
        $verifikasiEmail = VerifikasiEmail::create($request->all());
        // cek ke gtk apakah sudah ada, jika sudah kirim email dan pass untuk login
        $gtk = Gtk::where('nik', $request->nik)->first();
        $to_name = $request->nama_lengkap;
        $to_email = $request->email;
        $nik = $request->nik;
        $token = md5($request->nik);
        $request['token'] = $token;
        $id = VerifikasiEmail::create($request->all());
        $password = \Str::random(6);
        if ($gtk) {
            $gtk->update(['password' => $password]);
            $template_email = "konfirmasi_pendaftaran_exist";
            $subject = "Konfirmasi Pendaftaran";
        } else {
            $template_email = "pendaftaran_daftar_ulang";
            $subject = "Verifikasi Email";
        }
        $data = array('name' => $to_name, "body" => "Konfirmasi Pendaftaran",'email' => $to_email,'password' => $password,'token' => $token);

        \Mail::send('emails.' . $template_email, $data, function ($message) use ($to_name, $to_email, $subject) {
            $message->to($to_email, $to_name)->subject($subject);
            $message->from(ENV('MAIL_FROM_ADDRESS'), ENV('MAIL_FROM_NAME'));
        });
        \Session::flash('message', 'silahkan cek email anda untuk instruksi selanjutnya');
            return redirect('/');
    }

    public function masuk()
    {
        return view('masuk');
    }

    public function store(PendaftaranCreateRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $request['nama_lengkap'] = strtoupper($request->nama_lengkap);
        $request['password'] = Hash::make($request->password);
        $request['is_approve'] = 1;
        Gtk::create($request->except(['confirm_password']));
        $to_name = $request->nama_lengkap;
        $to_email = $request->email;
        $data = array('name' => $to_name, "body" => "Konfirmasi Pendaftaran");
        \Mail::send('emails.konfirmasi_pendaftaran', $data, function ($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Konfirmasi Pendaftaran Akun');
            $message->from(ENV('MAIL_FROM_ADDRESS'), ENV('MAIL_FROM_NAME'));
        });

        if (Auth::guard('gtk')->attempt($credentials)) {
            \Session::flash('message', 'Pendaftaran Berhasil');
            return redirect('/profile');
        } else {
            \Session::flash('message', 'Pendaftaran Gagal');
            return redirect('/');
        }
    }



    public function showApprove($id)
    {
        $data['gtk'] = Gtk::findOrFail($id);

        return view('detail-approve', $data);
    }


    public function doApprove($id)
    {
        $gtk = Gtk::findOrFail($id);
        $gtk->update(['is_approve' => 1]);

        \Session::flash('message', 'Akun bernama <strong>' . $gtk->nama_lengkap . '</strong> berhasil diapprove.');
        return redirect('daftarApprove');
    }


    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('gtk')->attempt($credentials)) {
            $gtk = Auth::guard('gtk')->user();
            if ($gtk->is_approve == 0) {
                return back()->with('failed', 'Akun anda belum diapprove oleh admin. Silahkan tunggu beberapa waktu');
            } else {
                return redirect('list-diklat')->with('message', 'Selamat datang, ' . $gtk->nama_lengkap);
            }
        } else {
            return back()->with('failed', 'Akun belum terdaftar atau kesalahan dalam input.');
        }
    }
    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    public function logout()
    {
        Auth::logout();
        Auth::guard('gtk')->logout();
        return redirect('/')->with('message', 'Anda Telah Berhasil Logout');
    }

    public function profileDiklatsaya()
    {
        $data['diklat'] = DiklatPeserta::with('diklat')->where('peserta_id', Auth::guard('gtk')->user()->id)->get();
        return view('diklat-saya', $data);
    }


    public function lupaPassword()
    {
        return view('lupa-password');
    }

    public function lupaPasswordAct(Request $request)
    {
        $gtk = Gtk::where('email', $request->email)->first();
        if ($gtk) {
            // send email
            $password = \Str::random(8);
            $gtk->update(['password' => \Hash::make($password)]);
            $to_name = $gtk->nama_lengkap;
            $to_email = $request->email;
            $data = array('name' => $to_name, "body" => "Konfirmasi Pendaftaran",'password' => $password,'email' => $to_email);
            \Mail::send('emails.konfirmasi_email_lupa_password', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject('Konfirmasi Lupa Password');
                $message->from(ENV('MAIL_FROM_ADDRESS'), ENV('MAIL_FROM_NAME'));
            });

            return redirect('lupa-password')->with('failed', 'Berhasil, Password Baru Sudah Dikirim Ke Email Anda');
        } else {
            return back()->with('failed', 'Email anda tidak ditemukan');
        }
    }

    public function diklatDetail($slug)
    {
        $data['bidangKeahlian'] = BidangKeahlian::all();
        $data['diklat']         = Diklat::find($slug);
        $data['diklatTerkait']  = Diklat::limit(3)->get();
        return view('diklat-detail', $data);
    }
}
