Hello <strong>{{ $name }}</strong>,
<p>Terima Kasih Sudah Melakukan Pendaftaran, Untuk Langkah Selanjutnya Silahkan Klik Link Dibawah Ini</p>
<p><a href="{{ url('pendaftaran?token='.$token.'')}}">Verifikasi Email</a></p>