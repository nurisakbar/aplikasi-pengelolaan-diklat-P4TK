@extends('layouts.app')
@section('title','Setting Gaji Pokok')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Gaji Pokok</h6>
    </div>
    <div class="card-body">
        @include('setting.navigasi')
        @include('alert')
        {!! Form::open(['url'=>'setting']) !!}
        {!! Form::hidden('jenis', 'gaji-pokok') !!}

        <table class="table table-bordered" id="users-table">
            @foreach($settingGajiPokok as $setting)
            <tr>
                <td width="200">Pegawai {{ $setting->keterangan }} 3 Bulan</td>
                <td> 
                    <div class="input-group col-md-4">
                    {{ Form::hidden('id[]',$setting->id) }}
                    {{ Form::text('jumlah[]',$setting->jumlah,['class'=>'form-control'])}}
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">/ 1x Hadir</span>
                      </div>
                    </div>
                </td>
            </tr>
            @endforeach
            <tr>
                <td width="200"></td>
                <td> <button type="submit" class="btn btn-primary">Simpan</button></td>
            </tr>
        </table>
        {{ Form::close() }}
@endsection
