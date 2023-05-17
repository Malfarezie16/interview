<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data </title>
</head>
<body>
    <h2 style="text-align: center; margin-bottom: 20px;">"data keseluruhan pengaduan"</h2>
    <table style="width: 100%;">
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Asal Sekolah</th>
            <th>Umur</th>
            <th>No Telp</th>
            <th>Pengalaman</th>
            <th>Tanggal</th>
            <th>Cv</th>
            <th>Status Response</th>
            <th>Pesan Response</th>
        </tr>
        @php $no =1; @endphp
        @foreach ($reports as $report)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$report['nama_lengkap']}}</td>
            <td>{{$report['asal_sekolah']}}</td>
            <td>{{$report['umur']}}</td>
            <td>{{$report['no_telp']}}</td>
            <td>{{$report ['pengalaman']}}</td>
            <td>{{\Carbon\Carbon::parse($report['created_at'])->format('j, F, Y')}}</td>
            <td><img src="assets/image/{{$report['foto']}}" width="80"></td>
            <td>
                        @if ($report['response'])
                        {{ $report['response']['status']}}
                        @else Not Found!
                        @endif
                    </td>
                    <td>
                    @if ($report['response'])
                        {{ $report['response']['pesan']}}
                        @else Not Found!
                        @endif
                    </td>
        </tr>
        @endforeach
    </table>

</body>
</html>
