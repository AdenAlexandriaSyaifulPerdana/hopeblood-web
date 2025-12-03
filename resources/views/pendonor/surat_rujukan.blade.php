<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Rujukan Donor Darah</title>

    <style>
        body {
            font-family: "Times New Roman", serif;
            margin: 40px;
            font-size: 12pt;
        }
        .kop {
            text-align: center;
            font-weight: bold;
            font-size: 14pt;
            margin-bottom: 20px;
        }
        .content {
            margin-top: 20px;
            line-height: 1.6;
        }
        .indent {
            text-indent: 30px;
        }
        .footer {
            margin-top: 60px;
            text-align: right;
        }
    </style>
</head>
<body>

    {{-- Kop Surat --}}
    <div class="kop">
        UNIT BANK DARAH <br>
        {{ $data->hospital->nama_rumah_sakit }} <br>
        {{ $data->hospital->alamat }} <br>
        Telp: {{ $data->hospital->nomer_hp }}<br>
        _________________________________________________________________________________________________________________
    </div>

    <div class="content">
        <p>
            Sehubungan dengan permohonan donor darah dan hasil pemeriksaan terhadap pendonor
            dengan data sebagai berikut:
        </p>

        <p>
            <b>Data Pendonor</b><br>
            Nama Pendonor : {{ $data->pendonor->name }} <br>
            Golongan Darah : {{ $data->pendonor->golongan_darah }} <br>
            Usia           : {{ $data->pendonor->usia }} Tahun <br>
            Alamat         : {{ $data->pendonor->alamat }} <br>
        </p>

        <p>
            <b>Informasi Donor</b><br>
            Lokasi Donor   : {{ $data->hospital->nama_rumah_sakit }} <br>
            Tanggal Donor  : {{ date('d-m-Y', strtotime($data->tanggal_donor)) }} <br>
            Waktu Donor    : {{ $data->waktu_donor }} <br>
        </p>

        <p class="indent">
            Dengan ini kami menyatakan bahwa pendonor tersebut bersedia melakukan donor
            sesuai dengan jadwal yang telah ditentukan. Untuk itu mohon dapat diproses
            lebih lanjut.
        </p>

        <p>Demikian surat rujukan ini dibuat. Atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p>
    </div>

    <div class="footer">
        <p>
            {{ $data->hospital->kota }}, {{ date('d-m-Y') }} <br>
            Penanggung Jawab BDRS <br><br><br><br>
            ( ____________________________ )
        </p>
    </div>

</body>
</html>
