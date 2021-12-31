@extends('layouts.app')
@section('title','Data GTK')
@section('content')
@include('gtk.__toolbar-show')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <div class="content flex-row-fluid" id="kt_content">
        @include('alert')
        <div id="alert"></div>

        <div class="row">
            <div class="col-md-6">
                <table class="table table-row-bordered">
                    <tr>
                        <td width="300">Nama Lengkap</td>
                        <th class="fw-bold">{{ $gtk->nama_lengkap }}</th>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <th class="fw-bold">{{ $gtk->nik }}</th>
                    </tr>
                    <tr>
                        <td>Instansi</td>
                        <th class="fw-bold">{{ $gtk->instansi->nama_instansi }}</th>
                    </tr>
                    <tr>
                        <td>Tempat Lahir</td>
                        <th class="fw-bold">{{ $gtk->tempat_lahir }}</th>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <th class="fw-bold">{{ $gtk->tanggal_lahir }}</th>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <th class="fw-bold">{{ $gtk->nip }}</th>
                    </tr>
                    <tr>
                        <td>NUPTK</td>
                        <th class="fw-bold">{{ $gtk->nuptk }}</th>
                    </tr>
                    <tr>
                        <td>Nomor UKG</td>
                        <th class="fw-bold">{{ $gtk->nomor_ukg }}</th>
                    </tr>
                    <tr>
                        <td>Golongan</td>
                        <th class="fw-bold">{{ $gtk->golongan }}</th>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-row-bordered">
                    <tr>
                        <td>Jabatan</td>
                        <th class="fw-bold">{{ $gtk->jabatan }}</th>
                    </tr>
                    <tr>
                        <td>Pendidikan Terakhir</td>
                        <th class="fw-bold">{{ $gtk->pendidikan_terakhir }}</th>
                    </tr>
                    <tr>
                        <td>Jurusan Pendidikan Terakhir</td>
                        <th class="fw-bold">{{ $gtk->jurusan_pendidikan_terakhir }}</th>
                    </tr>
                    <tr>
                        <td width="300">Agama</td>
                        <th class="fw-bold">{{ $gtk->agama }}</th>
                    </tr>
                    <tr>
                        <td>Domisili</td>
                        <th class="fw-bold">{{ $gtk->domisi_alamat_jalan }}, {{ $gtk->domisili_nama_dusun }}</th>
                    </tr>
                    <tr>
                        <td>RT/RW</td>
                        <th class="fw-bold">{{ $gtk->domisili_rt }}/{{ $gtk->domisili_rw }}</th>
                    </tr>
                    <tr>
                        <td>Nomor HP</td>
                        <th class="fw-bold">{{ $gtk->nomor_hp }}</th>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <th class="fw-bold">{{ $gtk->email }}</th>
                    </tr>
                    <tr>
                        <td>NPWP</td>
                        <th class="fw-bold">{{ $gtk->npwp }}</th>
                    </tr>
                    
                </table>
            </div>
            
        </div>
        
        <hr>
        <h3>Daftar Riwayat Diklat</h3>
        <hr>

        <table class="table table-rounded table-striped border gy-7 gs-7" id="users-table">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                    <th width="10">No</th>
                    <th>Nama Diklat</th>
                    <th>Departemen</th>
                    <th>Program Keahlian</th>
                    <th>Kategori Diklat</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Tahun</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayats as $riwayat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $riwayat->diklat->nama_diklat }}</td>
                        <td>{{ $riwayat->diklat->departemen->nama_departemen }}</td>
                        <td>{{ $riwayat->diklat->programKeahlian->nama_program_keahlian }}</td>
                        <td>{{ $riwayat->diklat->kategori->nama_kategori }}</td>
                        <td>{{ $riwayat->diklat->tanggal_mulai }}</td>
                        <td>{{ $riwayat->diklat->tanggal_selesai }}</td>
                        <td>{{ $riwayat->diklat->tahun }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>

</div>
@endsection

