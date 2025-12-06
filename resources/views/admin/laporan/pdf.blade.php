<!DOCTYPE html>
<html>
<head>
    <title>Laporan {{ $tahun }}</title>
    <style>
        body { font-family: sans-serif; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td, th { border: 1px solid black; padding: 8px; }
    </style>
</head>
<body>

<h2>LAPORAN DARAH TAHUN {{ $tahun }}</h2>

<table>
    <tr>
        <th>Total Permohonan</th>
        <td>{{ $totalPermohonan }}</td>
    </tr>
    <tr>
        <th>ACC</th>
        <td>{{ $totalAcc }}</td>
    </tr>
    <tr>
        <th>Reject</th>
        <td>{{ $totalReject }}</td>
    </tr>
    <tr>
        <th>Keberhasilan</th>
        <td>{{ $persenAcc }} %</td>
    </tr>
</table>

</body>
</html>
