@extends('layouts.app')
@section('title', 'Profile')
@section('content')
    @include('dashboard-gtk.toolbar')
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <div class="content flex-row-fluid" id="kt_content">
            @include('alert')
            <div class="card">
                <div class="card-body py-4">
                    @include('validation_error')
                    {!! Form::model($gtk, ['url' => 'updateProfile/' . $gtk->id, 'method' => 'PUT']) !!}
                    <div class="row mb-10">
                        <div class="col-md-4 mb-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">NIK</label>
                                    {!! Form::number('nik', null, ['class' => 'form-control', 'placeholder' => 'NIK']) !!}
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap</label>
                                    {!! Form::text('nama_lengkap', null, ['class' => 'form-control', 'placeholder' => 'Nama lengkap']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Tempat Lahir</label>
                                    {!! Form::text('tempat_lahir', null, ['class' => 'form-control', 'placeholder' => 'Tempat lahir']) !!}
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Lahir</label>
                                    {!! Form::date('tanggal_lahir', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-5">
                            <div class="mb-4">
                                <label for="" class="form-label">Jenis Kelamin</label>
                            </div>
                            <div class="form-check form-check-inline">
                                {{ Form::radio('jenis_kelamin', 'L', null, ['class' => 'form-check-input']) }}
                                <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                {{ Form::radio('jenis_kelamin', 'P', null, ['class' => 'form-check-input']) }}
                                <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                            </div>
                        </div>

                        <div class="col-md-4 mb-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">NIP</label>
                                    {!! Form::text('nip', null, ['class' => 'form-control', 'placeholder' => 'NIP']) !!}
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">NPWP</label>
                                    {!! Form::text('npwp', null, ['class' => 'form-control', 'placeholder' => 'NPWP']) !!}
                                </div>
        
                            </div>
                        </div>

                        <div class="col-md-4 mb-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">NUPTK</label>
                                    {!! Form::text('nuptk', null, ['class' => 'form-control', 'placeholder' => 'NUPTK']) !!}
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nomor UKG</label>
                                    {!! Form::number('nomor_ukg', null, ['class' => 'form-control', 'placeholder' => 'Nomor UKG']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-5">
                            <div class="row">
                                <div class="col-md-7">
                                    <label class="form-label">Status</label>
                                    {!! Form::select('status',['Guru'=>'Guru','Tenaga Kependidikan'=>'Tenaga Kependidikan','Instruktur LKP'=>'Indtstuktur LPK','Dosen'=>'Dosen'], null, ['class' => 'form-control', 'placeholder' => '-- Pilih Status --']) !!}
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label">Golongan</label>
                                    {!! Form::text('golongan', null, ['class' => 'form-control', 'placeholder' => 'Golongan']) !!}
                                </div>
                            </div>
                        </div>
                        
    
                        <div class="col-md-4 mb-5">
                            <label class="form-label">Jabatan</label>
                            {!! Form::text('jabatan', null, ['class' => 'form-control', 'placeholder' => 'Jabatan']) !!}
                        </div>
                        <div class="col-md-4 mb-5">
                            <div class="row">
                                <div class="col-md-7">
                                    <label class="form-label">Agama</label>
                                    {!! Form::select('agama', $agama, null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label">Pendidikan Terakhir</label>
                                    {!! Form::select('pendidikan_terakhir',['SD'=>'SD','SMP'=>'SMP','SMA','SMA','S1'=>'S1','S2'=>'S2'], null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-5">
                            <label class="form-label">Jurusan Pendidikan Terakhir</label>
                                    {!! Form::text('jurusan_pendidikan_terakhir', null, ['class' => 'form-control', 'placeholder' => 'Jurusan pendidikan terakhir']) !!}
   
                        </div>

                        <div class="col-md-4 mb-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Domisili Alamat Jalan</label>
                                    {!! Form::text('domisi_alamat_jalan', null, ['class' => 'form-control', 'placeholder' => 'Domisili alamat jalan']) !!}
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Domisili Nama Dusun</label>
                                    {!! Form::text('domisili_nama_dusun', null, ['class' => 'form-control', 'placeholder' => 'Domisili nama dusun']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-5">
                            <label class="form-label">Desa</label>
                            <select name="village_id" id="desa" class="desa form-control" style="height: 100px;"
                                placeholder="Masukan Nama Desa">
                                @if (isset($gtk->village->id))
                                    <option value="{{ $gtk->village_id }}">{{ $gtk->village->name }}</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-md-4 mb-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">RT</label>
                                    {!! Form::number('domisili_rt', null, ['class' => 'form-control', 'placeholder' => 'RT']) !!}
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">RW</label>
                                    {!! Form::number('domisili_rw', null, ['class' => 'form-control', 'placeholder' => 'RW']) !!}
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Kode Pos</label>
                                    {!! Form::number('domisili_kode_pos', null, ['class' => 'form-control', 'placeholder' => 'kode pos']) !!}
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4 mb-3">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="form-label">Nomor HP</label>
                                    {!! Form::text('nomor_hp', null, ['class' => 'form-control', 'placeholder' => 'Nomor HP']) !!}
              
                                </div>
                                <div class="col-md-7">
                                    <label class="form-label">Email</label>
                                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
        
                                </div>
                            </div>
                        </div>
   

                        <div class="col-md-4 mb-4">
                            <label class="form-label">Kompetensi Keahlian</label>
                            <select name="kompetensi_keahlian_id" id="kompetensi_keahlian" class="kompetensi_keahlian form-control" style="height: 100px;"
                                placeholder="Masukan Nama Instansi">
                                @if (isset($gtk))
                                    <option value="{{ $gtk->kompetensi_keahlian_id }}">
                                        {{ $gtk->kompetensiKeahlian->nama_kompetensi_keahlian }}
                                    </option>
                                @endif
                            </select>
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="form-label">Instansi</label>
                            <select name="instansi_id" id="instansi" class="instansi form-control" style="height: 100px;"
                                placeholder="Masukan Nama Instansi">
                                @if (isset($gtk))
                                    <option value="{{ $gtk->instansi_id }}">{{ $gtk->instansi->nama_instansi }}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="mb-10">
                        <button type="submit" class="btn btn-danger">Simpan Perubahan</button>
                        <a href="/gtk" class="btn btn-danger">Kembali</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {

            $('.desa').select2({
                placeholder: 'Masukan Nama Desa',
                ajax: {
                    url: '/ajax/select2Desa',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            $('.instansi').select2({
                placeholder: 'Cari Nama Instansi',
                ajax: {
                    url: '/ajax/select2Instansi',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.nama_instansi,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            $('.kompetensi_keahlian').select2({
                placeholder: 'Cari Kompetensi Keahlian',
                ajax: {
                    url: '/ajax/select2KompetensiKeahlian',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.nama_kompetensi_keahlian,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        });
    </script>
@endpush

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-choice, .select2-result-label {
        font-size: 1.5em;
        height: 41px; 
        overflow: auto;
        }

        .select2-arrow, .select2-chosen {
        padding-top: 6px;
        }
    </style>
@endpush
