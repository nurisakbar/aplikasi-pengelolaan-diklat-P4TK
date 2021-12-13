<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Absensi;
use App\User;
use App\Jabatan;
use App\Exports\AbsensiExport;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
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

    public function getAnggota()
    {
        $leader_jabatan_id      = Auth::user()->jabatan_id;
        $jabatan_id_kelompok    = Jabatan::where('jabatan_id', $leader_jabatan_id)->first();
        $users                  = User::where('jabatan_id', $jabatan_id_kelompok->id)->get();
        return $users;
    }

    public function index(Request $request)
    {
        $data['tanggal_start']  = $request->tanggal_start == null ? date('Y-m-d') : $request->tanggal_start;
        $data['tanggal_end']    = $request->tanggal_end == null ? date('Y-m-d') : $request->tanggal_end;

        if ($request->has('action')) {
            if ($request->action == 'download') {
                return Excel::download(new AbsensiExport($data['tanggal_start'], $data['tanggal_end']), 'laporan-kehadiran.xlsx');
            }
        }


        if (Auth::user()->level != 'administrator') {
            if (Auth::user()->level == 'kelompok') {
                $absensi                = Absensi::with('user')->where('user_id', Auth::user()->id);
            } else {
                $leader_jabatan_id      = Auth::user()->jabatan_id;
                $jabatan_id_kelompok    = Jabatan::where('jabatan_id', $leader_jabatan_id)->first();
                $users                  = User::where('jabatan_id', $jabatan_id_kelompok->id)->pluck('id');
                $absensi                = Absensi::with('user')->whereIn('user_id', $users);
            }
        } else {
            $absensi = Absensi::with('user');
        }

        if ($request->ajax()) {
            return \DataTables::of($absensi->whereBetween('tanggal', [$request->tanggal_start,$request->tanggal_end])->get())
            ->addColumn(
                'action',
                function ($row) {
                    $btn = '<a class="btn btn-danger btn-sm" href="/absensi/' . $row->id . '/edit"><i class="fas fa-edit" aria-hidden="true"></i></a>';
                    return $btn;
                }
            )
            ->addColumn(
                'status_kehadiran',
                function ($row) {
                    return $row->status_kehadiran == 'h' ? 'Hadir' : 'Tidak Hadir';
                }
            )
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

        return view('absensi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->level != 'administrator') {
            $data['users'] = $this->getAnggota();
        } else {
            $data['users'] = User::where('level', 'leader')->get();
        }

        return view('absensi.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count_row = count($request->user_id);
        $absensi = [];
        for ($i = 0; $i <= ($count_row - 1); $i++) {
            $absensi[] = [
                'user_id'           =>  $request->user_id[$i],
                'status_kehadiran'  =>  $request->status_kehadiran[$i],
                'tanggal'           => $request->tanggal,
                'keterangan'        => $request->keterangan[$i]
            ];
        }
        Absensi::insert($absensi);
        \Session::flash('message', 'Data absensi Berhasil Ditambahkan');
        return redirect('absensi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['absensi']   = Absensi::findOrFail($id);
        $data['users'] = User::where('id', $data['absensi']->user_id)->get();
        return view('absensi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $count_row = count($request->user_id);
        for ($i = 0; $i <= ($count_row - 1); $i++) {
            Absensi::find($request->id[$i])->update(['keterangan' => $request->keterangan[$i],'status_kehadiran' => $request->status_kehadiran[$i]]);
        }

        \Session::flash('message', 'Data absensi Berhasil Diperbaharui');
        return redirect('absensi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();
        \Session::flash('message', 'Data absensi Berhasil Dihapus');
        return redirect('absensi');
    }
}
