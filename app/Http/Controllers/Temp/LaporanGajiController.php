<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gaji;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\User;
use App\SettingGajiPokok;
use Auth;
use App\Exports\LaporanGajiExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanGajiController extends Controller
{
    public function index(Request $request)
    {
        $data['periode'] = $request->periode ?? date('Y-m');

        // if ($request->ajax()) {
        //     $gaji  = Gaji::with('user.jabatan')->where('periode_gaji', $request->periode);
        //     if ($gaji->count() <= 1) {
        //         // create new
        //         $users = User::all();
        //         foreach ($users as $user) {
        //             Gaji::create(['user_id' => $user->id,'periode_gaji' => $data['periode']]);
        //         }
        //     }

        //     if (Auth::user()->level != 'administrator') {
        //         $gaji = $gaji->where('user_id', Auth::user()->id);
        //     }

        //     // filter administrator
        //     $admin = User::where('level', '=', 'administrator')->pluck('id');
        //     $gaji = $gaji->whereNotIn('user_id', $admin);

        //     return \DataTables::of($gaji->get())
        //     ->addColumn('action', function ($row) {

        //         return '<a class="btn btn-danger btn-sm" href="/gaji/' . $row->id . '/pdf"><i class="fas fa-file-pdf" aria-hidden="true"></i></a>';
        //     })
        //     ->addColumn('lama_bekerja', function ($row) {
        //         return lama_kerja($row->user->tanggal_mulai_bekerja, $row->periode_gaji . '-01') . ' Bulan';
        //     })

        //     ->addColumn('total_hadir', function ($row) {
        //         $total_hadir = hitung_absensi($row->user_id, $row->periode_gaji . '-01', $row->periode_gaji . '-31', 'h');
        //         \DB::table('gaji')->where('id', $row->id)->update(['total_hadir' => $total_hadir]);
        //         return $total_hadir;
        //     })

        //     ->addColumn('gaji_pokok', function ($row) {
        //         $gaji_pokok = laporan_gaji_gaji_pokok($row);
        //         \DB::table('gaji')->where('id', $row->id)->update(['gaji_pokok' => $gaji_pokok]);
        //         return rupiah($gaji_pokok);
        //     })

        //     ->addColumn('tunjangan_jabatan', function ($row) {
        //         $tunjangan_jabatan = laporan_gaji_tunjangan_jabatan($row);
        //         \DB::table('gaji')->where('id', $row->id)->update(['tunjangan_jabatan' => $tunjangan_jabatan]);
        //         return rupiah($tunjangan_jabatan);
        //     })

        //     ->addColumn('bonus', function ($row) {
        //         $bonus = laporan_gaji_bonus($row);
        //         \DB::table('gaji')->where('id', $row->id)->update(['bonus' => $bonus]);
        //         return rupiah($bonus);
        //     })

        //     ->addColumn('total_gaji', function ($row) {
        //         return rupiah(laporan_gaji_bonus($row) + laporan_gaji_tunjangan_jabatan($row) + laporan_gaji_gaji_pokok($row));
        //     })

        //     ->rawColumns(['action','tunjangan'])
        //     ->addIndexColumn()
        //     ->make(true);
        // }

        if ($request->has('action')) {
            if ($request->action == 'excel') {
                return Excel::download(new LaporanGajiExport($data['periode']), 'laporan-gaji.xlsx');
            }
        }
        $gaji  = Gaji::with('user.jabatan')->where('periode_gaji', $data['periode']);
        if ($gaji->count() <= 1) {
            // create new
            $users = User::all();
            foreach ($users as $user) {
                Gaji::create(['user_id' => $user->id,'periode_gaji' => $data['periode']]);
            }
        }

        if (Auth::user()->level != 'administrator') {
            $gaji = $gaji->where('user_id', Auth::user()->id);
        }

        // filter administrator
        $admin          = User::where('level', '=', 'administrator')->pluck('id');
        $gaji           = $gaji->whereNotIn('user_id', $admin);
        $data['gaji']   = $gaji->get();
        return view('gaji.index', $data);
    }

    public function pdf($id)
    {
        $gaji = Gaji::with('user.jabatan')->findOrFail($id);
        //return $gaji;
        $fpdf = new FPDF('L', 'mm', array(100,150));
        $fpdf->AddPage();
        $fpdf->SetFont('arial', 'B', 12);
        $fpdf->Cell(130, 8, 'SLIP GAJI PEGAWAI', 0, 1, 'C');
        $fpdf->Cell(130, 8, 'WFN GROUP', 0, 1, 'C');

        $fpdf->Cell(50, 3, '', 0, 1);

        $fpdf->SetFont('arial', 'B', 10);
        $fpdf->Cell(50, 5, 'Nama Pegawai', 0, 0);
        $fpdf->Cell(100, 5, ' : ' . $gaji->user->name, 0, 1);
        $fpdf->Cell(50, 5, 'Jabatan', 0, 0);
        $fpdf->Cell(100, 5, ' : ' . $gaji->user->jabatan->nama_jabatan, 0, 1);
        $fpdf->Cell(50, 5, 'Periode', 0, 0);
        $fpdf->Cell(100, 5, ' : ' . $gaji->periode_gaji, 0, 1);

        $fpdf->SetFont('arial', '', 10);
        $fpdf->Cell(50, 3, '', 0, 1);

        $fpdf->Cell(13, 6, 'Nomor', 1, 0);
        $fpdf->Cell(67, 6, 'Keterangan', 1, 0);
        $fpdf->Cell(50, 6, 'Nominal', 1, 1);

        $fpdf->Cell(13, 6, '1', 1, 0);
        $fpdf->Cell(67, 6, 'Gaji Pokok', 1, 0);
        $gaji_pokok = laporan_gaji_gaji_pokok($gaji);
        $fpdf->Cell(50, 6, rupiah($gaji_pokok), 1, 1);

        $fpdf->Cell(13, 6, '2', 1, 0);
        $fpdf->Cell(67, 6, 'Tunjangan Jabatan', 1, 0);
        $tunjangan_jabatan = laporan_gaji_tunjangan_jabatan($gaji);
        $fpdf->Cell(50, 6, rupiah($tunjangan_jabatan), 1, 1);

        $fpdf->Cell(13, 6, '3', 1, 0);
        $fpdf->Cell(67, 6, 'Bonus', 1, 0);
        $bonus = laporan_gaji_bonus($gaji);
        $fpdf->Cell(50, 6, rupiah($bonus) . '', 1, 1);

        $fpdf->Cell(13, 6, '', 1, 0);
        $total = $gaji_pokok + $tunjangan_jabatan + $bonus;
        $fpdf->Cell(67, 6, 'Total Gaji', 1, 0);
        $fpdf->Cell(50, 6, rupiah($total), 1, 1);

        $fpdf->Output();
        exit;
    }
}
