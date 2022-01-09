@if (isset($user))
    <input type="hidden" id="jabatan_id_value" value="{{ $user->jabatan_id }}">
@endif
<div class="row mb-3">
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label for="exampleInputEmail1">Nama Pegawai</label>
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nama Lengkap']) !!}
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1">Jabatan</label>
            {!! Form::select('role', $roles, null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary">Simpan</button>
<a href="/user" class="btn btn-primary">Kembali</a>


@push('scripts')
    <script>
        $(document).ready(function() {
            load_kelompok();
        });

        function load_kelompok() {
            var level = $(".level").val();
            var url = window.location.pathname;

            $.ajax({
                url: "/user/dropdown-jabatan",
                cache: false,
                data: {
                    level: level
                },
                success: function(html) {
                    $("#dropdown_jabatan").html(html);
                    if (url != '/user/create') {
                        $(".jabatan_id").val($("#jabatan_id_value").val()).change();
                    }

                }
            });

            if (level == 'leader') {
                $("#label_jabatan").html("Pilih Leader");
            } else {
                $("#label_jabatan").html("Pilih Kelompok");
            }
        }
    </script>
@endpush
