<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Rujukan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 13px;
            line-height: 1.6;
            padding: 20px;
        }
        h2, h3 {
            text-align: center;
            margin: 0 0 10px 0;
        }
        .rujukan {
            page-break-after: always;
            margin-bottom: 50px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        td {
            padding: 3px 6px;
            vertical-align: top;
        }
        .label {
            width: 150px;
            font-weight: bold;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
        }
    </style>
</head>
<body>
    <h2>UNIT KESEHATAN SEKOLAH</h2>
    <h2><STRONG>_______________________________________________________</STRONG></h2>
    <h3>SURAT RUJUKAN SMK</h3>

    @foreach($rujukans as $rujukan)
        <div class="rujukan">
            <p><strong>Kepada : {{ @$rujukan->tujuan }}</strong></p>
            <p>Mohon Pemeriksaan / tindakan lebih lanjut</p>
            <table>
                <tr><td style="padding-left: 30px;" class="label">Nama</td><td>: {{ $rujukan->kunjungan->nama }}</td></tr>
                <tr><td style="padding-left: 30px;" class="label">Umur</td><td>: {{ $rujukan->kunjungan->umur }} tahun</td></tr>
                <tr><td style="padding-left: 30px;" class="label">Alamat Rujukan</td><td>: {{ $rujukan->alamat }}</td></tr>
                <tr><td style="padding-left: 30px;" class="label">Diagnosa</td><td>: {{ $rujukan->diagnosa }}</td></tr>
            </table>

            <p>Demikian surat rujukan ini diberikan untuk dapat di pergunakan semestinya </p>

            <div class="footer">
            <table style="width: 100%;">
            <tr>
        <td style="text-align: left;">Mengetahui,</td>
        <td style="text-align: right;">{{ \Carbon\Carbon::parse($rujukan->created_at)->translatedFormat('d F Y') }}</td>
             </tr>
            <td style="text-align: left;">Kepala / Guru kelas</td>
            <td style="text-align: right;">petugas uks</td>
             <tr><td></td></tr>
             <tr><td></td></tr>
             <tr><td></td></tr>
             <tr><td></td></tr>
             <tr><td></td></tr>
             <tr><td></td></tr>
             <tr><td></td></tr>
             <tr><td></td></tr>
             <tr><td></td></tr>
             <tr><td></td></tr>
             <tr><td></td></tr>
             <tr>
                            <tr>
            <td style="text-align: left;">______________________</td>
            <td style="text-align: right;"><strong>{{ $rujukan->kunjungan->user->username ?? '-' }}</strong></td>  
            </tr>
             </tr>
</table>
        @endforeach
    </body>
    </html>