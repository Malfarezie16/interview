<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interview</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">


</head>

<body>
    <header>
        {{-- kalo uda login, button yang dimunculin button buat masuk ke halaman data --}}
        @if (Auth::check())
            @if (Auth::user()->role == 'admin')
                <a href="{{ route('data') }}" class="login-btn">Lihat Data</a>
            @elseif (Auth::user()->role == 'petugas')
                <a href="{{ route('data.petugas') }}" class="login-btn">Lihat Data</a>
            @endif

            {{-- kalau dia belum login, button yang dimunculkan button buat ke halaman login --}}
        @else
            <a href="{{ route('login') }}" class="login-btn">MASUK</a>
        @endif
    </header>

    <section class="baris">
        <div class="kolom kolom1">
            <h2 style="text-align:left;">Syarat-Syarat Yang Harus Terpenuhi</h2>
            <ol>
                 <li>loyalitas, yaitu kesetiaan terhadap organisasi dan pekerjaannya</li>
                 <li>dapat menyimpan rahasia, terutama karena pekerjaannya banyak berkaitan dengan informasi-informasi penting dan rahasia perusahaan</li>
                 <li>ketekunan dan kerajinan</li>
                 <li>kerapian</li>
            </ol>
        </div>
        <div class="kolom kolom2">
        </div>
    </section>
    <section class="form-container">
        <div class="card form-card">
            <h2 style="text-align: center; margin-bottom: 20px;">Ajukan Pendaftaran</h2>

            @if ($errors->any())
                <ul style="width: 100%; background: red; padding: 10px">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            @if (Session::get('success'))
                <div style="width: 100%; background: green; padding: 5px">
                    {{ Session::get('success') }}
                </div>
            @endif

            <form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-card">
                    <label for="">Nama Lengkap:</label>
                    <input type="text" name="nik" id="">
                </div>
                <div class="input-card">
                    <label for="">Asal Sekolah:</label>
                    <input type="text" name="nama" id="">
                </div>
                <div class="input-card">
                    <label for="">Umur :</label>
                    <input type="number" name="no_telp" id="">
                </div>
                <div class="input-card">
                    <label for="">No Telp :</label>
                    <input type="number" name="no_telp" id="">
                </div>
                <div class="input-card">
                    <label for="">Pengalaman:</label>
                    <textarea rows="5" name="pengaduan"></textarea>
                </div>
                <div class="input-card">
                    <label for="">Upload CV :</label>
                    <input type="file" name="foto">
                </div>
                <button type="submit">Kirim</button>
            </form>
        </div>
    </section>
</body>

</html>
