<!DOCTYPE html>
<html>
<head>
    <title>Surat Pengantar PKL</title>
    <style>
        /* Gaya CSS khusus untuk Cetak Surat */
        body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.5; }
        .header { text-align: center; border-bottom: 3px double black; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2, .header h3 { margin: 0; }
        .content { margin-left: 20px; margin-right: 20px; }
        .table-data { width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 20px; }
        .table-data td { padding: 5px; vertical-align: top; }
        .ttd { float: right; width: 300px; margin-top: 50px; text-align: left; }
    </style>
</head>
<body>

    <div class="header">
        <h3>PEMERINTAH PROVINSI JAWA BARAT</h3>
        <h2>SMK NEGERI CONTOH DIGITAL</h2>
        <small>Jl. Teknologi No. 1, Kota Internet, Telp: (021) 123456</small>
    </div>

    <div class="content">
        <table>
            <tr>
                <td width="60">Nomor</td>
                <td>: {{ $placement->letter_number ?? '-' }}</td> </tr>
            <tr>
                <td>Lampiran</td>
                <td>: -</td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td>: <strong>Permohonan Praktik Kerja Lapangan (PKL)</strong></td>
            </tr>
        </table>

        <br>
        <p>Yth. Pimpinan <strong>{{ $placement->company->name }}</strong><br>
        Di Tempat</p>

        <p style="text-align: justify;">
            Dengan hormat,<br>
            Sehubungan dengan pelaksanaan program kurikulum Sekolah Menengah Kejuruan (SMK), 
            kami bermaksud mengajukan permohonan kepada Bapak/Ibu agar dapat menerima siswa kami 
            untuk melaksanakan Praktik Kerja Lapangan (PKL) di perusahaan yang Bapak/Ibu pimpin.
        </p>

        <p>Adapun data siswa tersebut adalah sebagai berikut:</p>

        <table class="table-data" border="1">
            <tr>
                <th style="text-align: left; padding: 5px;">Nama Siswa</th>
                <th style="text-align: left; padding: 5px;">NIS</th>
                <th style="text-align: left; padding: 5px;">Kelas</th>
                <th style="text-align: left; padding: 5px;">No. HP</th>
            </tr>
            <tr>
                <td>{{ $placement->student->name }}</td>
                <td>{{ $placement->student->nis }}</td>
                <td>{{ $placement->student->class_name }}</td>
                <td>{{ $placement->student->phone }}</td>
            </tr>
        </table>

        <p>
            Waktu pelaksanaan PKL direncanakan mulai tanggal 
            <strong>{{ \Carbon\Carbon::parse($placement->start_date)->translatedFormat('d F Y') }}</strong> 
            sampai dengan 
            <strong>{{ \Carbon\Carbon::parse($placement->end_date)->translatedFormat('d F Y') }}</strong>.
        </p>

        <p style="text-align: justify;">
            Demikian surat permohonan ini kami sampaikan. Besar harapan kami agar permohonan ini dapat dikabulkan. 
            Atas perhatian dan kerja samanya, kami ucapkan terima kasih.
        </p>

        <div class="ttd">
            <p>
                Bekasi, {{ now()->translatedFormat('d F Y') }}<br>
                Kepala Hubungan Industri,
            </p>
            <br><br><br>
            <p>
                <strong><u>Drs. Budi Administrator, M.Pd</u></strong><br>
                NIP. 19800101 200012 1 001
            </p>
        </div>
    </div>

</body>
</html>