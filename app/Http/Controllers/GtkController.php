<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GtkCreateRequest;
use App\Gtk;
use Auth;
use Storage;

class GtkController extends Controller
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

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $search         = $request->input('search.value');
            $columns        = $request->get('columns');
            $count_total    = Gtk::count();
            $count_filter   = Gtk::where('nopes', 'LIKE', '%' . $search . '%')
                            ->orWhere('nama_gtk', 'LIKE', '%' . $search . '%')
                            ->count();

            $items = Gtk::take(10);
            return \DataTables::of($items)
            ->with([
                'recordsTotal' => $count_total,
                'recordsFiltered' => $count_filter,
              ])
            ->addColumn('action', function ($row) {
                $btn = \Form::open(['url' => '/gtk/' . $row->nopes, 'method' => 'DELETE','style' => 'float:right;margin-right:5px']);
                $btn .= "<button type='submit' class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                $btn .= \Form::close();
                $btn .= '<a class="btn btn-danger btn-sm" href="/gtk/' . $row->nopes . '/edit"><i class="fas fa-edit" aria-hidden="true"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
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
        $data['leader'] = Gtk::where('level', 'leader')->pluck('nama_gtk', 'id');
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
        $request['Gtk::_id'] = $request->level == 'leader' ? null : $request->Gtk::_id;
        Gtk::create($request->all());
        \Session::flash('message', 'Data Gtk:: Berhasil Ditambahkan');
        return redirect('gtk::');
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
    public function edit($id)
    {
        $data['Gtk::']   = Gtk::findOrFail($id);
        $data['leader'] = Gtk::where('level', 'leader')->pluck('nama_gtk', 'id');
        return view('gtk::.edit', $data);
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
