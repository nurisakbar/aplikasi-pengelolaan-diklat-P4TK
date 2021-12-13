@extends('layouts.app')
@section('title','Laporan Gaji')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan Gaji</h6>
    </div>
    <div class="card-body">
        @include('alert')
        {!! Form::open(['url'=>'gaji','method'=>'GET']) !!}
        <table class="table table-bordered">
            <tr>
              <td width="200">Periode Gaji</td>
              <td width="200">
                <input id="NoIconDemo" class="form-control" name="periode" type="text" value="{{$periode}}" />
              </td>
              <td>
                  <button type="submit" name="action" value="filter" class="btn btn-danger btn btn-sm">Tampilkan</button>
                  @if (Auth::user()->level == 'administrator')
                    <button type="submit" name="action" value="excel" class="btn btn-danger btn btn-sm">Download Excel</button>
                  @endif
              </td>
            </tr>
          </table>
        </form>
        <hr>
        <div class="table-responsive">
        <table class="table table-bordered" id="example">
            <thead>
                <tr>
                    <th width="10">No</th>
                    <th>Periode</th>
                    <th>Nama Pegawai</th>
                    <th>Jabatan</th>
                    <th>Lama Bekerja</th>
                    <th>Total Hadir</th>
                    <th>Gaji Pokok</th>
                    <th>Tunjangan Jabatan</th>
                    <th>Bonus</th>
                    <th>Total Gaji</th>
                    <th width="20">#</th>
                </tr>
            </thead>
            <tbody>
                <?php $total_gaji = 0; ?>
                @foreach($gaji as $row)
                    <tr>
                        <td> {{ $loop->iteration }}</td>
                        <td> {{ $row->periode_gaji }}</td>
                        <td> {{ $row->user->name }}</td>
                        <td> {{ $row->user->jabatan->nama_jabatan }}</td>
                        <td> {{ lama_kerja($row->user->tanggal_mulai_bekerja, $row->periode_gaji . '-01') . ' Bulan' }}</td>
                        <?php
                        $total_hadir = hitung_absensi($row->user_id, $row->periode_gaji . '-01', $row->periode_gaji . '-31', 'h');
                        $gaji_pokok = laporan_gaji_gaji_pokok($row);
                        $tunjangan_jabatan = laporan_gaji_tunjangan_jabatan($row);
                        $bonus = laporan_gaji_bonus($row);
                        $gaji = laporan_gaji_bonus($row) + laporan_gaji_tunjangan_jabatan($row) + laporan_gaji_gaji_pokok($row);
                        $total_gaji = $total_gaji + $gaji;
                        \DB::table('gaji')->where('id', $row->id)->update([
                            'total_hadir'       => $total_hadir,
                            'gaji_pokok'        => $gaji_pokok,
                            'tunjangan_jabatan' => $tunjangan_jabatan,
                            'bonus'             => $bonus
                        ]);
                        ?>
                        <td> {{ $total_hadir }}</td>
                        <td> {{ $gaji_pokok }}</td>
                        <td> {{ $tunjangan_jabatan }}</td>
                        <td> {{ $bonus }}</td>
                        <td> {{ $gaji }}</td>
                        <td><a class="btn btn-danger btn-sm" href="/gaji/{{ $row->id }}/pdf"><i class="fas fa-file-pdf" aria-hidden="true"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="text-right font-weight-bold">
                    <td colspan="8">Total Gaji</td>
                    <td colspan="2">{{ $total_gaji }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js" integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA=" crossorigin="anonymous"></script>
<script src="{{asset('jquery-ui-month-picker-master/src/MonthPicker.js')}}"></script>
<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
$(function() {
    $('#NoIconDemo').MonthPicker({
      Button: false,
      OnAfterChooseMonth: function () {
        const period = $(this).val()
        $("#export_pdf").attr("href", "/gaji/export?periode="+ period)
      }
    });
    $("#NoIconDemo").MonthPicker('option', 'MonthFormat','yy-mm');


    $('#example').DataTable({
        "iDisplayLength": 100,
        "aLengthMenu": [[10, 25, 50, 100,200,300], ["10", "25", "50", "100","200","300"]]
    });
});
</script>
@endpush

@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('jquery-ui-month-picker-master/src/MonthPicker.css')}}">
@endpush


