@extends('layouts.app')
@section('title', 'Update Profile')
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
                            <label class="form-label">Nama Lengkap</label>
                            {!! Form::text('nama_lengkap', null, ['class' => 'form-control', 'placeholder' => 'Nama lengkap']) !!}
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="form-label">NIK</label>
                            {!! Form::number('nik', null, ['class' => 'form-control', 'placeholder' => 'NIK']) !!}
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="form-label">Tempat Lahir</label>
                            {!! Form::text('tempat_lahir', null, ['class' => 'form-control', 'placeholder' => 'Tempat lahir']) !!}
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="form-label">Tanggal Lahir</label>
                            {!! Form::date('tanggal_lahir', null, ['class' => 'form-control']) !!}
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
                            <label class="form-label">NIP</label>
                            {!! Form::text('nip', null, ['class' => 'form-control', 'placeholder' => 'NIP']) !!}
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="form-label">NUPTK</label>
                            {!! Form::text('nuptk', null, ['class' => 'form-control', 'placeholder' => 'NUPTK']) !!}
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="form-label">Nomor UKG</label>
                            {!! Form::number('nomor_ukg', null, ['class' => 'form-control', 'placeholder' => 'Nomor UKG']) !!}
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="form-label">Golongan</label>
                            {!! Form::text('golongan', null, ['class' => 'form-control', 'placeholder' => 'Golongan']) !!}
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="form-label">Jabatan</label>
                            {!! Form::text('jabatan', null, ['class' => 'form-control', 'placeholder' => 'Jabatan']) !!}
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="form-label">Pendidikan Terakhir</label>
                            {!! Form::text('pendidikan_terakhir', null, ['class' => 'form-control', 'placeholder' => 'Pendidikan terakhir']) !!}
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="form-label">Jurusan Pendidikan Terakhir</label>
                            {!! Form::text('jurusan_pendidikan_terakhir', null, ['class' => 'form-control', 'placeholder' => 'Jurusan pendidikan terakhir']) !!}
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="form-label">Agama</label>
                            {!! Form::select('agama', $agama, null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="form-label">Domisili Alamat Jalan</label>
                            {!! Form::text('domisi_alamat_jalan', null, ['class' => 'form-control', 'placeholder' => 'Domisili alamat jalan']) !!}
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="form-label">Domisili Nama Dusun</label>
                            {!! Form::text('domisili_nama_dusun', null, ['class' => 'form-control', 'placeholder' => 'Domisili nama dusun']) !!}
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="form-label">Domisili Kode Pos</label>
                            {!! Form::number('domisili_kode_pos', null, ['class' => 'form-control', 'placeholder' => 'Domisili kode pos']) !!}
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="form-label">Domisili RT</label>
                            {!! Form::number('domisili_rt', null, ['class' => 'form-control', 'placeholder' => 'Domisili RT']) !!}
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="form-label">Domisili RW</label>
                            {!! Form::number('domisili_rw', null, ['class' => 'form-control', 'placeholder' => 'Domisili RW']) !!}
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="form-label">Nomor HP</label>
                            {!! Form::text('nomor_hp', null, ['class' => 'form-control', 'placeholder' => 'Nomor HP']) !!}
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="form-label">Email</label>
                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="form-label">NPWP</label>
                            {!! Form::text('npwp', null, ['class' => 'form-control', 'placeholder' => 'NPWP']) !!}
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
        });
    </script>
@endpush

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
