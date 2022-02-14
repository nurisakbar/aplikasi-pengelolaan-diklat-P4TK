<?php

namespace App\Http\Controllers;

use App\Departemen;
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
use App\BidangKeahlian;
use App\Exports\DiklatExport;
use App\Instansi;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Maatwebsite\Excel\Facades\Excel;

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

            $items          = Diklat::with('kategori', 'programKeahlian', 'departemen')
                            ->orderBy('tanggal_mulai', 'ASC')
                            ->take(10);

            return \DataTables::of($items)
                ->with([
                    'recordsTotal' => $count_total,
                    'recordsFiltered' => $count_filter,
                ])
                ->addColumn('action', function ($row) {
                    $btn = \Form::open(['url' => '/diklat/' . $row->id, 'method' => 'DELETE', 'style' => 'float:right;margin-right:5px']);
                    $btn .= "<button type='submit' class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                    $btn .= \Form::close();
                    $btn .= '<a class="btn btn-danger btn-sm" href="/diklat/' . $row->id . '/edit"><i class="fas fa-edit" aria-hidden="true"></i></a> ';
                    $btn .= '<a class="btn btn-danger btn-sm" href="/diklat/' . $row->id . '"><i class="fas fa-eye" aria-hidden="true"></i></a>';
                    return $btn;
                })
                ->addColumn('jumlah_peserta', function ($row) {
                    return $row->peserta()->count();
                })
                ->addColumn('tanggal_mulai', function ($row) {
                    return date_format(date_create($row->tanggal_mulai), "d/m/Y");
                })
                ->addColumn('tanggal_selesai', function ($row) {
                    return date_format(date_create($row->tanggal_selesai), "d/m/Y");
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        $data['departemen'] = Departemen::pluck('nama_departemen', 'id');
        return view('diklat.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['departemen'] = Departemen::pluck('nama_departemen', 'id');
        $data['kategori'] = KategoriDiklat::pluck('nama_kategori', 'id');
        $data['bidangKeahlian'] = BidangKeahlian::pluck('nama_bidang_keahlian', 'id');
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
            DiklatKelas::create(['diklat_id' => $diklat->id, 'nama_kelas' => $kelasDiklat]);
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
        $data['diklat'] = Diklat::with('peserta.gtk.instansi.wilayahAdministratif')->findOrFail($id);

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
        $data['kelas']      = DiklatKelas::where('diklat_id', $id)->pluck('nama_kelas', 'id');
        return view('diklat.show', $data);
    }

    public function export($id, Request $request)
    {
        $type = $request->type;
        $data['diklat'] = Diklat::with('peserta.gtk.instansi.wilayahAdministratif', 'peserta.kelas', 'kategori', 'programKeahlian')->findOrFail($id);
        if ($type == 'pdf') {
            return \PDF::loadView('diklat.pdf', $data)->setPaper('A4', 'landscape')->stream();
        } else {
            return Excel::download(new DiklatExport($request->segment(2)), 'Diklat.xlsx');
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
        $data['diklat']   = Diklat::findOrFail($id);
        $data['departemen'] = Departemen::pluck('nama_departemen', 'id');
        $data['kategori'] = KategoriDiklat::pluck('nama_kategori', 'id');
        $data['bidangKeahlian'] = BidangKeahlian::pluck('nama_bidang_keahlian', 'id');
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
        DiklatKelas::where('diklat_id', $id)->delete();
        DiklatPeserta::where('diklat_id', $id)->forceDelete();
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


        $diklat = $request->only('tahun', 'tanggal_mulai', 'tanggal_selesai', 'departemen_id');
        $peserta_diklat_id = [];

        foreach ($reader->getSheetIterator() as $sheet) {
            $nomor = 1;
            foreach ($sheet->getRowIterator() as $row) {
                $cells                      = $row->getCells();
                $program_diklat             = $cells[11]->getValue();
                $nama_diklat                = $cells[12]->getValue();



                $kategori_diklat            = KategoriDiklat::firstOrCreate(['nama_kategori' => $program_diklat], ['nama_kategori' => $program_diklat]);
                if ($nomor == 2) {
                    $program_keahlian_diklat    = $cells[13]->getValue();
                    // check program keahlian
                    $kompetensi_keahlian = KompetensiKeahlian::where('nama_kompetensi_keahlian', $program_keahlian_diklat)->first();
                    if ($kompetensi_keahlian == null) {
                        return redirect('diklat')->with('message', 'Program Keahlian ' . $program_keahlian_diklat . ' Belum Terdata Pada Kompetensi Keahlian');
                    }
                    $diklat['nama_diklat']              = $nama_diklat;
                    $diklat['quota']                    = 0;
                    $diklat['kompetensi_keahlian']      = $kompetensi_keahlian->id;
                    $diklat['status_aktif']             = 'Selesai';
                    $diklat['kategori_diklat_id']       = $kategori_diklat->id;
                    $diklat['program_keahlian_id']      = $kompetensi_keahlian->program_keahlian_id;
                }
                if ($nomor > 1) {
                    // check profile GTK, kalau belum ada akan dicreate
                    $peserta_diklat_id[]     = $this->gtkInfo($cells);
                }
                $nomor++;
            }
        }

        $createDiklat   = Diklat::create($diklat);
        $createKelas    = DiklatKelas::create(['nama_kelas' => 'Kelas A', 'diklat_id' => $createDiklat->id]);
        $peserta_diklat = [];
        foreach ($peserta_diklat_id as $peserta_id) {
            DiklatPeserta::insert(['peserta_id' => $peserta_id, 'diklat_id' => $createDiklat->id, 'diklat_kelas_id' => $createKelas->id, 'status_kehadiran' => 'Terkonfirmasi']);
        }


        \Session::flash('message', 'Data Diklat Berhasil Di Import');
        return redirect('diklat/' . $createDiklat->id);
    }

    public function importDiklat(Request $request)
    {
        $file = $request->file('file');
        $nama_file = $file->getClientOriginalName();
        $destinationPath = 'uploads';
        $file->move($destinationPath, $nama_file);

        $filePath = $destinationPath . '/' . $nama_file;
        $reader = ReaderEntityFactory::createXLSXReader();
        $reader->open($filePath);

        foreach ($reader->getSheetIterator() as $sheet) {
            $nomor = 1;
            foreach ($sheet->getRowIterator() as $row) {
                if ($nomor > 2) {
                    $cells                      = $row->getCells();
                    //dd($cells);
                    $nama_kategori              = $cells[2]->getValue();
                    $kategori                   = KategoriDiklat::firstOrCreate(['nama_kategori' => $nama_kategori], ['nama_kategori' => $nama_kategori]);
                    $nama_diklat                = $cells[1]->getValue();
                    $kompetensi_keahlian        = $cells[3]->getValue();
                    $durasi                     = $cells[4]->getValue();
                    $quota                      = $cells[5]->getValue();
                    $tglMulai                   = (array) $cells[6]->getValue();
                    $tglAkhir                   = (array) $cells[7]->getValue();
                    $nama_departemen            = $cells[8]->getValue();
                    $departemen                 = Departemen::firstOrCreate(['nama_departemen' => $nama_departemen], ['nama_departemen' => $nama_departemen]);
                    $kelas                      = $cells[9]->getValue();
                    $tahun                      = $cells[10]->getValue();

                    $data = [
                        'nama_diklat'           => $nama_diklat,
                        'tahun'                 => $tahun,
                        'quota'                 => (int)$quota,
                        'program_keahlian_id'   => 1,
                        'status_aktif'          => 'Tidak',
                        'kategori_diklat_id'    => $kategori->id,
                        'tanggal_mulai'         => substr($tglMulai['date'], 0, 10),
                        'tanggal_selesai'       => substr($tglAkhir['date'], 0, 10),
                        'departemen_id'         => $departemen->id,
                        'jenis'                 => 'ya',
                        'bidang_keahlian_id'    => $kompetensi_keahlian,
                        'pola_diklat'           => (int)$durasi
                    ];

                    Diklat::create($data);
                }
                $nomor++;
            }
        }

        return redirect('diklat/')->with('message', 'Import Berhasil');
    }


    public function gtkInfo($row)
    {
        $gtk = Gtk::firstOrCreate([
            'nomor_ukg' => $row[1]->getValue()
        ], [
            'nomor_ukg'             => $row[2]->getValue(),
            'nama_lengkap'          => $row[2]->getValue(),
            'instansi_id'           => $this->instansiInfo($row[7]->getValue()), // mendapatkan sekolah_id dari tabel sekolah
            'jenis_kelamin'         => $row[4]->getValue(),
            'nomor_hp'              => $row[5]->getValue(),
            'email'                 => $row[6]->getValue()
        ]);

        return $gtk->id;
    }

    public function instansiInfo($nama_instansi)
    {
        $instansi = Instansi::where('nama_instansi', $nama_instansi)->first();
        return $instansi->id;
    }
}
