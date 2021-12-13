<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\User;
use App\Group;
use App\Jabatan;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Exports\DataKaryawanExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function verify()
    {
        if (Auth::user()->level != 'administrator') {
            abort(404);
        }
    }

    public function index(Request $request)
    {
        $this->verify();
        if ($request->ajax()) {
            return \DataTables::of(User::with('jabatan')->get())
            ->addColumn('action', function ($user) {
                $btn = \Form::open(['url' => 'user/' . $user->id, 'method' => 'DELETE','style' => 'float:right;margin-right:5px']);
                $btn .= "<button type='submit' class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                $btn .= \Form::close();
                $btn .= '<a class="btn btn-danger btn-sm" href="/user/' . $user->id . '/edit"><i class="fas fa-edit" aria-hidden="true"></i></a>';
                return $btn;
            })
            ->addColumn('toko', function ($user) {
                $list = "";
                foreach ($user->toko as $t) {
                    $list .= "- " . $t->nama_toko . "<br>";
                }
                return $list;
            })
            ->addColumn('jabatan', function ($user) {
                return $user->jabatan->nama_jabatan ?? null;
            })
            ->addColumn('lama_kerja', function ($user) {
                return $user->tanggal_mulai_bekerja == '0000-00-00' ? '-' : \Carbon\Carbon::parse($user->tanggal_mulai_bekerja)->diffInMonths(date('Y-m-d')) . ' Bulan';
            })
            ->rawColumns(['action','toko'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['jabatan'] = Jabatan::pluck('nama_jabatan', 'id');
        return view('user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $data               = $request->all();
        if ($request->hasFile('photo')) {
            $file       = $request->file('photo');
            $fileName   = 'photo' . time() . '.' . $file->getClientOriginalExtension();
            \Storage::putFileAs('public', $request->file('photo'), $fileName);
            $data['photo'] = $fileName;
        }

        $data['password']   = Hash::make($request->password);
        $data['user_id']    = Auth::user()->id;
        User::create($data);
        \Session::flash('message', 'Berhasil Menambahkan Data');
        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $data['jabatan'] = Jabatan::pluck('nama_jabatan', 'id');
        $data['user']   = User::find($id);
        return view('user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();
        if ($request->password != null) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }
        if ($request->hasFile('photo')) {
            $file       = $request->file('photo');
            $fileName   = 'photo' . time() . '.' . $file->getClientOriginalExtension();
            \Storage::putFileAs('public', $request->file('photo'), $fileName);
            $data['photo'] = $fileName;
        }
        $user->update($data);
        \Session::flash('message', 'Berhasil Mengupdate Data ' . $request->name);
        if ($request->has('page')) {
            return redirect('profile');
        }
        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        \Session::flash('message', 'Berhasil Menghapus Data Anggota');
        return redirect('user');
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $data['user']   = User::find($id);
        return view('user.profile', $data);
    }

    public function excel()
    {
        return Excel::download(new  DataKaryawanExport(), 'laporan-data-karyawan.xlsx');
    }

    public function dropdownJabatan(Request $request)
    {
        $jabatan = Jabatan::where('level', $request->level)->pluck('nama_jabatan', 'id');
        return \Form::select('jabatan_id', $jabatan, null, ['class' => 'form-control jabatan_id']);
    }
}
