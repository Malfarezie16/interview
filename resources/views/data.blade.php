<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>data </title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>

<body>
    <h2 class="title-table">DATA PENDAFTARAN KERJA</h2>
    <div style="display: flex; justify-content: center; margin-bottom: 30px">
        <a href="logout" style="text-align: center">Logout</a>
        <div style="margin: 0 10px"> | </div>
        <a href="/" style="text-align: center">Home</a>
    </div>
    <div style="display: flex; justify-content: flex-end; align-items: center;">
        <form action="" method="GET">
            @csrf
            {{--menggunakan method GET karna route unutk masuk ke halaman data ini menggunakan ::get--}}
            <input type="text" name="search" placeholder="Cari berdasarkan nama...">
            <button type="submit" class="btn-login" style="margin-top: -1px">Cari</button>
        </form>
        {{-- refresh balik lagi ke route data karna nanti pas di kluk refresh mau bersihin riwayat pencarian
             sebelumnya dan balikin lagi nya ke halaman data lagi--}}
        <a href="{{route('data')}}" class="btn-login" style="margin-left: 10px; margin-top: -2px">Refresh</a>
        <a href="{{route('export-pdf')}}"  style="margin-left: 10px; margin-top: -2px">Cetak PDF</a>
        <a href="{{route('export.excel')}}"  style="margin-left: 10px; margin-top: -2px">Cetak Excel</a>
    </div>
    <div style="padding: 0 30px">
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>Asal Sekolah</th>
                    <th>Umur</th>
                    <th>No Telp</th>
                    <th>Pengalaman</th>
                    <th>CV</th>
                    <th>Status Response</th>
                    <th>Pesan Response</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($reports as $report)
                <tr>
                    {{--menambahkan angka 1 dari $no di php tiap baris nya--}}
                    <td>{{$no++}}</td>
                    <td>{{$report ['nama_lengkap']}}</td>
                    <td>{{$report ['asal_sekolah']}}</td>
                    <td>{{$report ['umur']}}</td>
                    @php
                    // substr_replace : mengubah karakter string
                    // punya 3 argumen. argumen ke-1 : data yang mau di masukan ke string
                    // argumen ke-2 : mulai dari index mana di ubahnya
                    // argumen ke-3 : samapi index mana di ubahnya
                    $telp = substr_replace($report->no_telp, "62", 0, 1)
                    @endphp
                    @php
                    if ($report->response) {
                        $pesanWA = 'hallo' . $report->nama . '! pendaftaran anda di' . $report->response['status'] . '.berikut pesan untuk anda :' . $report->response['pesan'];
                    }
                    else { $pesanWA = 'belum ada data response';
                    }
                    @endphp
                    <td><a href="https://wa.me/{{$telp}}?text={{$pesanWA}}" target="_blank">{{$telp}}</a></td>
                    <td>{{$report ['pengalaman']}}</td>
                    <td>
                        <a href="../assets/image/{{$report->foto}}" target="_blank">
                        <img src="{{asset('assets/image/'.$report->foto)}}" width="120">
        </a>
                    </td>
                    <td>
                        @if ($report->response)
                        {{ $report->response['status']}}
                        @else Not Found!
                        @endif
                    </td>
                      <td>
                        @if ($report->response)
                        {{ $report->response['pesan']}}
                        @else Not Found!
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('delete', $report->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" >Delete</button>
                        </form>
                        <form action="{{route('created.pdf', $report->id) }}" method="GET" style="margin-top: 20px">


                                <button type="submit">Print</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
