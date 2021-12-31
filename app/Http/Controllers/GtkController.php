<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GtkCreateRequest;
use App\Gtk;
use Auth;
use Storage;

class GtkController extends Controller
{
    protected $agama;
    public function __construct()
    {
        $this->middleware('auth');
        $this->agama = [
            'islam'    => 'Islam',
            'kristen'  => 'Kristen',
            'katolik'  => 'Katolik',
            'hindu'    => 'Hindu',
            'buddha'   => 'Buddha',
            'konghucu' => 'Konghucu'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $search         = $request->input('search.value');
            $columns        = $request->get('columns');
            $count_total    = Gtk::count();
            $count_filter   = Gtk::with('instansi.wilayahAdministratif')
                ->where('gtk.nama_lengkap', 'LIKE', '%' . $search . '%')
                ->orWhere('gtk.nomor_ukg', 'LIKE', '%' . $search . '%')
                ->count();

            $items = Gtk::with('instansi.wilayahAdministratif')->orderBy('nomor_ukg', 'ASC')->take(10);

            return \DataTables::of($items)
                ->with([
                    'recordsTotal' => $count_total,
                    'recordsFiltered' => $count_filter,
                ])
                ->addColumn('action', function ($row) {
                    $btn = \Form::open(['url' => '/gtk/' . $row->id, 'method' => 'DELETE', 'style' => 'float:right;margin-right:5px']);
                    $btn .= "<button type='submit' class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                    $btn .= \Form::close();
                    $btn .= '<a class="btn btn-danger btn-sm" href="/gtk/' . $row->id . '/edit"><i class="fas fa-edit" aria-hidden="true"></i></a>';
                    return $btn;
                })
                ->addColumn('keterangan', function ($row) {
                    return '';
                })
                ->addColumn('umur', function ($row) {
                    return \Carbon\Carbon::parse($row->tanggal_lahir)->diff(\Carbon\Carbon::now())->format('%y');
                })
                ->addColumn('pilih', function ($row) {
                    $btn = '<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onClick="tutup_modal_gtk(' . $row->id . ')" data-target="#modalPesertaTerpilih">Pilih</button>';
                    return $btn;
                })
                ->rawColumns(['action', 'pilih'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('gtk.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['agama'] = $this->agama;
        return view('gtk.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GtkCreateRequest $request)
    {
        Gtk::create($request->all());
        \Session::flash('message', 'Data Gtk Berhasil Ditambahkan');
        return redirect('gtk');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        if ($request->ajax()) {
            return Gtk::with('instansi.wilayahAdministratif')->findOrFail($id);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['gtk']   = Gtk::with('village', 'instansi')->findOrFail($id);
        $data['agama'] = $this->agama;
        return view('gtk.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GtkCreateRequest $request, $id)
    {
        $gtk = Gtk::findOrFail($id);
        $gtk->update($request->all());
        \Session::flash('message', 'Data Guru Berhasil Diperbaharui');
        return redirect('gtk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gtk = Gtk::findOrFail($id);
        $gtk->delete();
        \Session::flash('message', 'Data Gtk Berhasil Dihapus');
        return redirect('gtk');
    }
}
