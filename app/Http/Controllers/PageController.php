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

class PageController extends Controller
{
    public function home()
    {
        $data['diklat'] = Diklat::with('programKeahlian', 'kategori')->paginate(9);
        return view('home', $data);
    }
    public function dashboard()
    {
        return view('dashboard');
    }

    public function pendaftaran()
    {
        return view('pendaftaran');
    }

    public function masuk()
    {
        return view('masuk');
    }

    public function store(PendaftaranCreateRequest $request)
    {
        $request['nama_lengkap'] = strtoupper($request->nama_lengkap);
        $request['password'] = Hash::make($request->password);
        Gtk::create($request->except(['confirm_password']));
        $to_name = $request->nama_lengkap;
        $to_email = $request->email;
        $data = array('name' => $to_name, "body" => "Konfirmasi Pendaftaran");
        \Mail::send('emails.konfirmasi_pendaftaran', $data, function ($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Konfirmasi Pendaftaran Akun');
            $message->from(ENV('MAIL_FROM_ADDRESS'), ENV('MAIL_FROM_NAME'));
        });
        \Session::flash('message', 'Terima kasih akun anda telah berhasil dibuat. Selanjutnya silahkan menunggu akun anda di approve oleh admin');
        return redirect('/');
    }

    public function approve(Request $request)
    {
        if ($request->ajax()) {
            return \DataTables::of(Gtk::where('is_approve', 0)->get())
                ->addColumn('action', function ($row) {
                    $btn = \Form::open(['url' => 'daftarApprove/' . $row->id, 'method' => 'POST', 'style' => 'float:right;margin-right:5px']);
                    $btn .= "<button type='submit' class='btn btn-success btn-sm'>Approve</button>";
                    $btn .= \Form::close();
                    $btn .= '<a class="btn btn-danger btn-sm" href="/daftarApprove/' . $row->id . '"><i class="fas fa-eye" aria-hidden="true"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('approve');
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
        $data['diklatTerkait']  = Diklat::all();
        return view('diklat-detail', $data);
    }
}
