<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Slip Gaji</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Slip Gaji Karyawan</h2>
    <p><strong>Nama:</strong> {{ $gaji->karyawan->nama_lengkap }}</p>
    <p><strong>Divisi:</strong> {{ $gaji->karyawan->divisi }}</p>
    <p><strong>Bulan:</strong> {{ \Carbon\Carbon::parse($gaji->bulan)->translatedFormat('F Y') }}</p>

    <table>
        <tr>
            <th>Komponen</th>
            <th>Jumlah</th>
        </tr>
        <tr>
            <td>Gaji Pokok</td>
            <td>Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Tunjangan</td>
            <td>Rp {{ number_format($gaji->tunjangan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Potongan Cuti</td>
            <td>- Rp {{ number_format($gaji->potongan_cuti, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Total Gaji Bersih</th>
            <th>Rp {{ number_format($gaji->gaji_pokok + $gaji->tunjangan - $gaji->potongan_cuti, 0, ',', '.') }}</th>
        </tr>
    </table>

    <p style="text-align:right; margin-top: 40px;">Bandung, {{ now()->translatedFormat('d F Y') }}</p>
</body>
</html>
