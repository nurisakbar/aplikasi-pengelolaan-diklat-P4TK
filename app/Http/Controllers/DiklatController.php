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
use App\ProgramKeahlian;
use App\KompetensiKeahlian;
use App\BidangKeahlian;
use App\Exports\DiklatExport;
use App\Exports\LaporanPesertaDiklat;
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
            \Log::info($request->all());
            \Log::info($request->order[0]['column']);
            $search         = $request->input('search.value');
            $columns        = $request->get('columns');
            $count_total    = Diklat::count();
            $count_filter   = Diklat::where('nama_diklat', 'LIKE', '%' . $search . '%')
                ->orWhere('tahun', 'LIKE', '%' . $search . '%')
                ->count();

            $items          = Diklat::with('kategori', 'programKeahlian', 'departemen');


            if ($request->has('order')) {
                if ($request->order[0]['column'] == 4) {
                    $orderColumn = 'tanggal_mulai';
                } else {
                    $orderColumn = 'tanggal_selesai';
                }
                $direction = $request->order[0]['dir'];

                $items = $items->orderBy($orderColumn, $direction);
            }

            if ($request->departemen_id != '') {
                $items = $items->where('departemen_id', $request->departemen_id);
            }

            if (!in_array($request->nama_diklat, ['undefined',null,''])) {
                $items = $items->where('nama_diklat', 'LIKE', "%" . $request->nama_diklat . "%");
            }

            if ($request->kategori_diklat_id != '') {
                $items = $items->where('kategori_diklat_id', $request->kategori_diklat_id);
            }

            if ($request->bidang_keahlian_id != '') {
                $items = $items->where('bidang_keahlian_id', $request->bidang_keahlian_id);
            }

            if (!in_array($request->program_keahlian_id, ['undefined',null])) {
                $items = $items->where('program_keahlian_id', $request->program_keahlian_id);
            }

            if ($request->tahun > 0) {
                $items = $items->where('tahun', $request->tahun);
            }


            return \DataTables::of($items->take(10))
                ->with([
                    'recordsTotal' => $count_total,
                    'recordsFiltered' => $count_filter,
                ])
                ->addColumn('action', function ($row) {
                    $btn = \Form::open(['url' => '/diklat/' . $row->id, 'method' => 'DELETE', 'style' => 'float:right;margin-right:5px']);
                    $btn .= "<button type='submit' class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                    $btn .= \Form::close();
                    $btn .= '<a class="btn btn-danger btn-sm" href="/diklat/' . $row->id . '/edit"><i class="fas fa-edit" aria-hidden="true"></i></a> ';
                    $btn .= '<a class="btn btn-danger btn-sm" href="/diklat/' . $row->id . '?tab=pendaftar"><i class="fas fa-eye" aria-hidden="true"></i></a>';
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
        $data['kategori'] = KategoriDiklat::pluck('nama_kategori', 'id');
        $data['bidangKeahlian'] = BidangKeahlian::pluck('nama_bidang_keahlian', 'id');
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
        $input = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = str_replace(" ", "", $file->getClientOriginalName());
            $file->move("image", $fileName);
            $input['image'] = $fileName;
        }



        $diklat = Diklat::create($input);
        \Session::flash('message', 'Data Diklat Berhasil Ditambahkan');
        DiklatKelas::create(['diklat_id' => $diklat->id, 'nama_kelas' => 'Kelas A']);
        return redirect('diklat/' . $diklat->id . '?tab=pendaftar');
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
            $peserta = $data['diklat']->peserta->where('status_kehadiran', ucfirst($request->status_kehadiran));
            return \DataTables::of($peserta)
                ->addColumn('action', function ($row) {
                    $btn = '<button class="btn btn-danger btn-sm" onclick="hapusPeserta(' . $row->id . ')"><i class="fa fa-trash" aria-hidden="true"></i></button> ';
                    $btn .= '<button class="btn btn-danger btn-sm" onclick="buka_modal_ubah_status(' . $row->id . ')"><i class="fa fa-edit" aria-hidden="true"></i></button> ';
                    return $btn;
                })
                ->addColumn('kelas', function ($row) {
                    return $row->kelas->nama_kelas;
                })
                ->rawColumns(['action','status_kehadiran'])
                ->addIndexColumn()
                ->make(true);
        }
        $data['provinsi']   = Provinsi::pluck('name', 'id');
        $data['kelas']      = DiklatKelas::where('diklat_id', $id)->pluck('nama_kelas', 'id');
        $data['kelas_all']      = DiklatKelas::where('diklat_id', $id)->get();
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
        if ($request->kelas_id == '') {
            return DiklatKelas::create($request->all());
        } else {
            $diklatKelas = DiklatKelas::findOrFail($request->kelas_id);
            return $diklatKelas->update($request->only('nama_kelas'));
        }
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
                $program_diklat             = $cells[11]->getValue(); // kategori
                $nama_diklat                = $cells[12]->getValue();
                $bidang_keahlian            = $cells[13]->getValue();
                $program_keahlian           = $cells[14]->getValue();
                $kompetensi_keahlian        = $cells[15]->getValue();



                $kategori_diklat            = KategoriDiklat::firstOrCreate(['nama_kategori' => $program_diklat], ['nama_kategori' => $program_diklat]);
                if ($nomor == 2) {
                    $bidangKeahlian         = BidangKeahlian::firstOrCreate(['nama_bidang_keahlian' => $bidang_keahlian], ['nama_bidang_keahlian' => $bidang_keahlian]);
                    $programKehalianParams  = ['nama_program_keahlian' => $program_keahlian,'bidang_keahlian_id' => $bidangKeahlian->id];
                    $programKeahlian        = ProgramKeahlian::firstOrCreate($programKehalianParams, $programKehalianParams);

                    if ($kompetensi_keahlian != null) {
                        $kompetensiKehalianParams = ['nama_kompetensi_keahlian' => $kompetensi_keahlian,'program_keahlian_id' => $programKeahlian->id];
                        $kompetensiKeahlian = KompetensiKeahlian::firstOrCreate($kompetensiKehalianParams, $kompetensiKehalianParams);
                    }

                    $kompetensi_keahlian_id = $kompetensi_keahlian == null ? null : $kompetensiKeahlian->id;
                    $bidang_keahlian_id     = $bidang_keahlian == null ? null : $bidangKeahlian->id;

                    $diklat['nama_diklat']              = $nama_diklat;
                    $diklat['quota']                    = 0;
                    $diklat['pola_diklat']              = $request->pola_diklat;
                    $diklat['status_aktif']             = 'Selesai';
                    $diklat['kategori_diklat_id']       = $kategori_diklat->id;
                    $diklat['program_keahlian_id']      = $programKeahlian->id;
                    $diklat['bidang_keahlian_id']       = $bidang_keahlian_id;
                    $diklat['kompetensi_keahlian_id']   = $kompetensi_keahlian_id;
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
            DiklatPeserta::insert(['peserta_id' => $peserta_id, 'diklat_id' => $createDiklat->id, 'diklat_kelas_id' => $createKelas->id, 'status_kehadiran' => 'Peserta']);
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
                if ($nomor > 1) {
                    $cells                      = $row->getCells();
                    //dd($cells);
                    $nama_kategori              = $cells[2]->getValue();
                    $kategori                   = KategoriDiklat::firstOrCreate(['nama_kategori' => $nama_kategori], ['nama_kategori' => $nama_kategori]);
                    $nama_diklat                = $cells[1]->getValue();
                    $bidangKeahlian             = BidangKeahlian::firstOrCreate(['nama_bidang_keahlian' => $cells[3]->getValue()], ['nama_bidang_keahlian' => $cells[3]->getValue()]);
                    $programKehalianParams      = ['nama_program_keahlian' => $cells[4]->getValue(),'bidang_keahlian_id' => $bidangKeahlian->id];
                    $program_keahlian           = ProgramKeahlian::firstOrCreate($programKehalianParams, $programKehalianParams);
                    $kompetensiKehalianParams   = ['nama_kompetensi_keahlian' => $cells[5]->getValue(),'program_keahlian_id' => $program_keahlian->id];
                    $kompetensi_keahlian        = KompetensiKeahlian::firstOrCreate($kompetensiKehalianParams, $kompetensiKehalianParams);

                    $durasi                     = $cells[6]->getValue();
                    $quota                      = $cells[7]->getValue();
                    $tglMulai                   = $cells[8]->getValue();
                    $tglAkhir                   = $cells[9]->getValue();
                    $nama_departemen            = $cells[11]->getValue();
                    $departemen                 = Departemen::firstOrCreate(['nama_departemen' => $nama_departemen], ['nama_departemen' => $nama_departemen]);
                    $tahun                      = $cells[10]->getValue();
                    $kelas                      = $cells[12]->getValue();

                    $data = [
                        'nama_diklat'               => $nama_diklat,
                        'tahun'                     => $tahun,
                        'quota'                     => (int)$quota,
                        'program_keahlian_id'       => $program_keahlian->id,
                        'status_aktif'              => 'Tidak',
                        'kategori_diklat_id'        => $kategori->id,
                        'tanggal_mulai'             => $tglAkhir,
                        'departemen_id'             => $departemen->id,
                        'jenis'                     => 'ya',
                        'bidang_keahlian_id'        => $bidangKeahlian->id,
                        'kompetensi_keahlian_id'    => $kompetensi_keahlian->id,
                        'pola_diklat'               => (int)$durasi
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
            'instansi_id'           => $this->instansiInfo($row[7]->getValue(), $row[8]->getValue()), // mendapatkan sekolah_id dari tabel sekolah
            'jenis_kelamin'         => $row[4]->getValue(),
            'nomor_hp'              => $row[5]->getValue(),
            'email'                 => $row[6]->getValue()
        ]);

        return $gtk->id;
    }

    public function instansiInfo($nama_instansi, $npsn)
    {
        $instansi = Instansi::where('nama_instansi', $nama_instansi)->orWhere('npsn')->first();
        return $instansi->id ?? 0;
    }

    public function laporanPesertaDiklat(Request $request)
    {
        if ($request->ajax()) {
            $filter_nama_diklat     = "";
            $filter_tahun           = "";
            $filter_nama_gtk        = "";
            $filter_nama_instansi   = "";
            $filter_provinsi        = "";
            $filter_kabupaten       = "";

            $status = $request->status == 'peserta' ? 'Peserta' : 'Pendaftar';

            if (!in_array($request->nama_diklat, ['undefined',null])) {
                $filter_nama_diklat = "and d.nama_diklat like '%" . $request->nama_diklat . "%'";
            }

            if (!in_array($request->nama_gtk, ['undefined',null])) {
                $filter_nama_gtk = "and gt.nama_lengkap like '%" . $request->nama_gtk . "%'";
            }

            if (!in_array($request->tahun, ['undefined',null])) {
                $filter_tahun = "and d.tahun='" . $request->tahun . "'";
            }


            if (!in_array($request->nama_instansi, ['undefined',null])) {
                $filter_nama_instansi = "and i.nama_instansi like '%" . $request->nama_instansi . "%'";
            }

            if (!in_array($request->province_id, ['undefined',null])) {
                $filter_provinsi  = "and i.province_id='" . $request->province_id . "'";
            }

            if (!in_array($request->regency_id, ['undefined',null])) {
                $filter_kabupaten = "and i.regency_id='" . $request->regency_id . "'";
            }

            $riwayatDiklat = \DB::select("
            select gt.nama_lengkap,
            gt.nik,
            gt.nomor_ukg,
            d.nama_diklat,
            d.tahun,
            i.nama_instansi,
            p.name as nama_provinsi,
            r.name as nama_kabupaten
            from diklat_peserta as dp join gtk as gt on gt.id=dp.peserta_id and dp.status_kehadiran='" . $status . "' $filter_nama_gtk 
            join diklat as d on d.id=dp.diklat_id $filter_nama_diklat $filter_tahun
            join instansi as i on i.id=gt.instansi_id $filter_nama_instansi
            join provinces as p on p.id=i.province_id $filter_provinsi
            join regencies as r on i.regency_id=r.id $filter_kabupaten");

            $count_total = count($riwayatDiklat);
            $count_filter = count($riwayatDiklat);

            return \DataTables::of($riwayatDiklat)
                ->with([
                    'recordsTotal' => $count_total,
                    'recordsFiltered' => $count_filter,
                ])
                ->addIndexColumn()
                ->make(true);
        }
        $data['totalApprove']   = Gtk::where('is_approve', 0)->count();
        $data['provinsi']       = Provinsi::pluck('name', 'id');
        return view('diklat.laporan-peserta-diklat', $data);
    }

    public function laporanPesertaDiklatExcel(Request $request)
    {
        return Excel::download(new LaporanPesertaDiklat($request->all()), 'Laporan-' . $request->status . '-Diklat.xlsx');
    }
}
