<?php

namespace App\Http\Controllers;

use App\Gtk;
use App\Http\Requests\PendaftaranCreateRequest;
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

    public function diklatDetail()
    {
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
        Gtk::create($request->all());
        \Session::flash('message', 'Terima kasih akun anda telah berhasil dibuat. Selanjutnya silahkan menunggu akun anda di approve oleh admin');
        return redirect('dashboard');
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
        return redirect('gtk');
    }
}
