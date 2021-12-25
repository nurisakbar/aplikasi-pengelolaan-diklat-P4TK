<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DiklatCreateRequest;
use App\Diklat;
use App\DiklatKelas;
use App\DiklatPeserta;
use App\Provinsi;
use Auth;
use App\Gtk;
use App\KategoriDiklat;
use App\KompetensiKeahlian;
use App\Sekolah;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class DiklatController extends Controller
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
            $count_total    = Diklat::count();
            $count_filter   = Diklat::where('nama_diklat', 'LIKE', '%' . $search . '%')
                            ->orWhere('tahun', 'LIKE', '%' . $search . '%')
                            ->count();

            $items          = Diklat::with('kategori')->take(10);

            return \DataTables::of($items)
            ->with([
                'recordsTotal' => $count_total,
                'recordsFiltered' => $count_filter,
              ])
            ->addColumn('action', function ($row) {
                $btn = \Form::open(['url' => '/diklat/' . $row->id, 'method' => 'DELETE','style' => 'float:right;margin-right:5px']);
                $btn .= "<button type='submit' class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                $btn .= \Form::close();
                $btn .= '<a class="btn btn-danger btn-sm" href="/diklat/' . $row->id . '/edit"><i class="fas fa-edit" aria-hidden="true"></i></a> ';
                $btn .= '<a class="btn btn-danger btn-sm" href="/diklat/' . $row->id . '"><i class="fas fa-eye" aria-hidden="true"></i></a>';
                return $btn;
            })
            ->addColumn('jumlah_peserta', function ($row) {
                return $row->peserta()->count();
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('diklat.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['kategori'] = KategoriDiklat::pluck('nama_kategori', 'id');
        return view('diklat.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiklatCreateRequest $request)
    {
        $diklat = Diklat::create($request->all());
        \Session::flash('message', 'Data Diklat Berhasil Ditambahkan');

        foreach ($request->kelas as $kelasDiklat) {
            DiklatKelas::create(['diklat_id' => $diklat->id,'nama_kelas' => $kelasDiklat]);
        }
        return redirect('diklat/' . $diklat->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $data['diklat'] = Diklat::with('peserta.gtk')->findOrFail($id);

        if ($request->ajax()) {
            $peserta = $data['diklat']->peserta;
            return \DataTables::of($peserta)
            ->addColumn('action', function ($row) {
                $btn = '<button class="btn btn-danger btn-sm" onclick="hapusPeserta(' . $row->id . ')"><i class="fa fa-trash" aria-hidden="true"></i></button> ';
                $btn .= '<button class="btn btn-danger btn-sm" onclick="buka_modal_ubah_status(' . $row->id . ')"><i class="fa fa-edit" aria-hidden="true"></i></button> ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $data['provinsi']   = Provinsi::pluck('name', 'id');
        $data['kelas']      = DiklatKelas::pluck('nama_kelas', 'id');
        return view('diklat.show', $data);
    }

    public function pdf($id)
    {
        $data['diklat'] = Diklat::with('peserta.gtk', 'peserta.kelas')->findOrFail($id);
        return \PDF::loadView('diklat.pdf', $data)->setPaper('A4', 'landscape')->stream();
        //return view('diklat.pdf', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['diklat']   = Diklat::findOrFail($id);
        return view('diklat.edit', $data);
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
        $diklat = Diklat::findOrFail($id);
        $diklat->update($request->all());
        \Session::flash('message', 'Data Diklat Berhasil Diperbaharui');
        return redirect('diklat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diklat = Diklat::findOrFail($id);
        $diklat->delete();
        \Session::flash('message', 'Data Diklat Berhasil Dihapus');
        return redirect('diklat');
    }


    public function tambahKelasDiklat(Request $request)
    {
        return DiklatKelas::create($request->all());
    }

    public function importRiwayatDiklat(Request $request)
    {
        $file = $request->file('file');
        $nama_file = $file->getClientOriginalName();
        $destinationPath = 'uploads';
        $file->move($destinationPath, $nama_file);

        $filePath = $destinationPath . '/' . $nama_file;
        $reader = ReaderEntityFactory::createXLSXReader();
        $reader->open($filePath);


        $diklat = $request->only('tahun', 'tanggal_mulai', 'tanggal_selesai');
        $peserta_diklat_nopes = [];

        foreach ($reader->getSheetIterator() as $sheet) {
            $nomor = 1;
            foreach ($sheet->getRowIterator() as $row) {
                $cells                      = $row->getCells();
                $program_diklat             = $cells[11]->getValue();
                $nama_diklat                = $cells[12]->getValue();
                $program_keahlian_diklat    = $cells[13]->getValue();

                $kategori_diklat            = KategoriDiklat::firstOrCreate(['nama_kategori' => $program_diklat], ['nama_kategori' => $program_diklat]);
                $kompetensi_keahlian        = KompetensiKeahlian::where('nama_kompetensi_keahlian', $program_keahlian_diklat)->first();
                if ($nomor == 2) {
                    $diklat['nama_diklat']              = $nama_diklat;
                    $diklat['quota']                    = 0;
                    $diklat['kompetensi_keahlian']      = $kompetensi_keahlian->id;
                    $diklat['departemen']               = "test";
                    $diklat['status_aktif']             = 'Selesai';
                    $diklat['kategori_diklat_id']       = $kategori_diklat->id;
                }
                if ($nomor > 1) {
                    // check profile GTK, kalau belum ada akan dicreate
                    $peserta_diklat_nopes[]     = $this->gtkInfo($cells);
                }
                $nomor++;
            }
        }

        $createDiklat   = Diklat::create($diklat);
        $createKelas    = DiklatKelas::create(['nama_kelas' => 'Kelas A','diklat_id' => $createDiklat->id]);
        $peserta_diklat = [];
        foreach ($peserta_diklat_nopes as $nopes) {
            DiklatPeserta::insert(['nopes' => $nopes, 'diklat_id' => $createDiklat->id,'diklat_kelas_id' => $createKelas->id,'status_kehadiran' => 'Terkonfirmasi']);
        }


        \Session::flash('message', 'Data Diklat Berhasil Di Import');
        return redirect('diklat/' . $createDiklat->id);
    }


    public function gtkInfo($row)
    {
        $gtk = Gtk::firstOrCreate([
            'nopes' => $row[1]->getValue()
        ], [
            'nopes'             => $row[2]->getValue(),
            'nama_gtk'          => $row[2]->getValue(),
            'sekolah_id'        => $this->sekolahInfo($row[7]->getValue()), // mendapatkan sekolah_id dari tabel sekolah
            'kelamin'           => $row[4]->getValue(),
            'umur'              => $row[3]->getValue(),
            'simkb_nomor_hp'    => $row[5]->getValue(),
            'simkb_email'       => $row[6]->getValue()
        ]);

        return $row[1]->getValue();
    }

    public function sekolahInfo($nama_sekolah)
    {
        $sekolah = Sekolah::where('nama_sekolah', $nama_sekolah)->first();
        return $sekolah->sekolah_id;
    }
}
