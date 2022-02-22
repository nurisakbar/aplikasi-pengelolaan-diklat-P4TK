<?php

namespace App\Http\Controllers;

use App\DiklatPeserta;
use Illuminate\Http\Request;
use App\Http\Requests\GtkCreateRequest;
use App\Gtk;
use Auth;
use Storage;
use App\Provinsi;

class GtkController extends Controller
{
    protected $agama;

    public function __construct()
    {
        $this->middleware('auth');
        $this->agama = config('datareferensi.agama');
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
            $items = GTK::select('gtk.id', 'jenis_kelamin', 'instansi.nama_instansi', 'nomor_hp', 'nama_lengkap', 'nomor_ukg', 'districts.name as nama_kecamatan', 'regencies.name as nama_kabupaten', 'provinces.name as nama_provinsi')
            ->join('instansi', 'instansi.id', 'gtk.instansi_id')
            ->join('districts', 'districts.id', 'instansi.district_id')
            ->join('regencies', 'regencies.id', 'districts.regency_id')
            ->join('provinces', 'provinces.id', 'regencies.province_id');

            if ($request->nama_gtk != null) {
                $searchName = $request->nama_gtk;
                $items->where('gtk.nama_lengkap', 'like', '%' . $searchName . '%');
                $items->orWhere('gtk.nik', 'like', '%' . $searchName . '%');
                $items->orWhere('gtk.nuptk', 'like', '%' . $searchName . '%');
                $items->orWhere('gtk.nomor_ukg', 'like', '%' . $searchName . '%');
                
            }

            if ($request->nama_instansi != null) {
                $searchByNameInstansi = $request->nama_instansi;
                // $items->where('nama_instansi', 'like', '%' . $searchByNameInstansi . '%');
                $clearStatusInstansi = str_replace(['SMK N ','SMK ','NEGERI ','SMKN'], ['','','',''], strtoupper($searchByNameInstansi));
                $items->where('nama_instansi', 'like', '%' . $clearStatusInstansi . '%');
            }

            if ($request->province_id != null) {
                $items->where('instansi.province_id', $request->province_id);
            }

            if (!in_array($request->regency_id, [null,'undefined'])) {
                $items->where('instansi.regency_id', $request->regency_id);
            }


            $count_filter  = $items->count();
            return \DataTables::of($items->limit(10))
                ->with([
                    'recordsTotal' => $count_total,
                    'recordsFiltered' => $count_filter,
                ])
                ->addColumn('action', function ($row) {
                    $btn = \Form::open(['url' => '/gtk/' . $row->id, 'method' => 'DELETE', 'style' => 'float:right;']);
                    $btn .= "<button type='submit' class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                    $btn .= \Form::close();
                    $btn .= '<a class="btn btn-danger btn-sm mx-1" href="/gtk/' . $row->id . '/edit"><i class="fas fa-edit" aria-hidden="true"></i></a>';
                    $btn .= '<a class="btn btn-danger btn-sm" href="/gtk/' . $row->id . '"><i class="fas fa-eye" aria-hidden="true"></i></a>';
                    return $btn;
                })
                ->addColumn('keterangan', function ($row) {
                    // mendapatkan tahun terakhir diklat
                    $riwayatDiklat = \DB::select("SELECT d.tahun FROM diklat_peserta as dp
                    join diklat as d on d.id=dp.diklat_id
                    where dp.peserta_id=" . $row->id . "
                    order by d.tahun desc limit 1");
                    // \Log::info($riwayatDiklat);
                    $tahun = $riwayatDiklat[0]->tahun ?? 'Belum Pernah';
                    return $tahun;
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
        $data['totalApprove'] = Gtk::where('is_approve', 0)->count();
        $data['provinsi']   = Provinsi::pluck('name', 'id');
        return view('gtk.index', $data);
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
        $request['is_approve'] = 1;
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

        $data['gtk'] = Gtk::with('instansi')->findOrFail($id);
        $data['riwayats'] = DiklatPeserta::with('diklat', 'kelas')->where('peserta_id', $id)->get();

        return view('gtk.show', $data);
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

    public function approve(Request $request)
    {
        if ($request->ajax()) {
            return \DataTables::of(Gtk::where('is_approve', 0)->get())
                ->addColumn('action', function ($row) {
                    $btn = \Form::open(['url' => 'daftarApprove/' . $row->id, 'method' => 'POST', 'style' => 'float:right;margin-right:5px']);
                    $btn .= "<button type='submit' class='btn btn-success btn-sm'>Approve</button>";
                    $btn .= \Form::close();
                    $btn .= '<a class="btn btn-danger btn-sm" href="/daftarApprove/' . $row->id . '"><i class="fas fa-eye" aria-hidden="true"></i></a>';
                    $btn .= '<a class="btn btn-danger btn-sm mx-1" href="/deleteApprove/' . $row->id . '"><i class="fas fa-times" aria-hidden="true"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('gtk.approve');
    }

    public function showApprove($id)
    {
        $data['gtk'] = Gtk::findOrFail($id);

        return view('gtk.detail-approve', $data);
    }

    public function doApprove($id)
    {
        $gtk = Gtk::findOrFail($id);
        $gtk->update(['is_approve' => 1]);

        \Session::flash('message', 'Akun bernama <strong>' . $gtk->nama_lengkap . '</strong> berhasil diapprove.');
        return redirect('gtk');
    }

    public function deleteApprove($id)
    {
        $gtk = Gtk::findOrFail($id);
        $gtk->delete();

        \Session::flash('message', 'Akun bernama <strong>' . $gtk->nama_lengkap . '</strong> berhasil ditolak dan dihapus.');
        return redirect('gtk');
    }
}
