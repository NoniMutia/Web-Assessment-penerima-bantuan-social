<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hasil Penilaian Bantuan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10px;
            margin: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
            word-wrap: break-word;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
            margin-top: 10px;
        }

        .status-layak {
            background-color: #c6efce;
            color: #006100;
            font-weight: bold;
        }
        .status-tidak {
            background-color: #ffc7ce;
            color: #9c0006;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Hasil Penilaian Calon Penerima Bantuan</h2>
    
    <table>
        <thead>
            <tr>
                <th style="width: 2%;">#</th>
                <th style="width: 10%;">NIK</th>
                <th style="width: 10%;">Nama</th>
                <th style="width: 8%;">Skor Penghasilan</th>
                <th style="width: 8%;">Skor Tanggungan</th>
                <th style="width: 8%;">Skor Rumah</th>
                <th style="width: 8%;">Skor Riwayat</th>
                <th style="width: 8%;">Skor Kendaraan</th>
                <th style="width: 8%;">Total Skor</th>
                <th style="width: 10%;">Riwayat Bantuan</th>
                <th style="width: 10%;">Jenis Kendaraan</th>
                <th style="width: 8%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->nik }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->skor_penghasilan }}</td>
                    <td>{{ $item->skor_tanggungan }}</td>
                    <td>{{ $item->skor_rumah }}</td>
                    <td>{{ $item->skor_riwayat }}</td>
                    <td>{{ $item->skor_kendaraan }}</td>
                    <td><strong>{{ $item->skor_akhir }}</strong></td>
                    <td>
                        @if($item->riwayat_bantuan)
                            {{ $item->riwayat_bantuan->jenis_bantuan }}<br>
                            {{ $item->riwayat_bantuan->tahun }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($item->kendaraan)
                            {{ $item->kendaraan->jenis_kendaraan }} ({{ $item->kendaraan->jumlah }})
                        @else
                            Tidak Ada
                        @endif
                    </td>
                    <td class="{{ $item->status_kelayakan === 'Layak' ? 'status-layak' : 'status-tidak' }}">
                        {{ $item->status_kelayakan }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
