Hello <strong>{{ $name }}</strong>,
<p>Terima Kasih Sudah Melakukan Pendaftaran, Kami Menemukan data anda sudah ada pada sistem database kami</p>
<p>Silahkan update profile anda dengan login menggunakan akun berikut</p>
<p>Email : <b>{{$email}}</b></p>
<p>Password : {{$password}}</p>

<a href="{{url('masuk')}}" style="background-color: #4CAF50; /* Green */
border: none;
color: white;
padding: 15px 32px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;">Klik Disini Untuk Melakukan Login</a>