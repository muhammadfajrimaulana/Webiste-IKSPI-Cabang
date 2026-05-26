<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Dokumen Pengesahan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 13px;
            line-height: 1.6;
            color: #000;
            padding: 20px;
        }

        .kop-surat {
            width: 100%;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .kop-tabel {
            width: 100%;
        }

        .judul-organisasi {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
        }

        .alamat {
            font-size: 10px;
            color: #333;
            margin: 0;
        }

        .judul-dokumen {
            text-align: center;
            margin: 30px 0;
        }

        .judul-dokumen h3 {
            font-size: 15px;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: underline;
            margin: 0;
        }

        .isi-dokumen {
            margin-top: 20px;
        }

        .data-grid {
            width: 100%;
            margin-top: 20px;
        }

        .data-grid td {
            padding: 5px 0;
            vertical-align: top;
        }

        .label {
            width: 30%;
            font-weight: bold;
        }

        .ttd-container {
            margin-top: 50px;
            float: right;
            width: 250px;
            text-align: center;
        }

        .ttd-space {
            margin-top: 70px;
            font-weight: bold;
            border-bottom: 1px solid #000;
        }
    </style>
</head>

<body>
    <div class="kop-surat">
        <table class="kop-tabel">
            <tr>
                <td style="width: 15%; text-align: center;">
                    <img src="{{ public_path('assets/img/logo-ikspi.png') }}" style="width: 60px;">
                </td>
                <td style="text-align: center;">
                    <div class="judul-organisasi">Ikatan Keluarga Silat Putra Indonesia</div>
                    <div class="judul-organisasi">IKS.PI KERA SAKTI</div>
                    <div class="alamat">Sekretariat Pengurus Cabang • Parung, Jawa Barat</div>
                </td>
                <td style="width: 15%;"></td>
            </tr>
        </table>
    </div>

    <div class="judul-dokumen">
        <h3>Surat Keterangan Pengesahan Anggota</h3>
        <p>Nomor: {{ now()->format('Y') }}/SKP/{{ $p->nomor_anggota }}</p>
    </div>

    <div class="isi-dokumen">
        <p>Yang bertanda tangan di bawah ini menerangkan bahwa:</p>

        <table class="data-grid">
            <tr>
                <td class="label">Nama Lengkap</td>
                <td>: {{ $p->nama_pengurus }}</td>
            </tr>
            <tr>
                <td class="label">Nomor Anggota</td>
                <td>: {{ $p->nomor_anggota }}</td>
            </tr>
            <tr>
                <td class="label">Tingkatan</td>
                <td>: {{ $p->tingkatan }}</td>
            </tr>
            <tr>
                <td class="label">Asal Ranting</td>
                <td>: {{ $p->ranting->nama_ranting ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Disahkan</td>
                <td>: {{ $p->created_at->format('d F Y') }}</td>
            </tr>
            <tr>
                <td class="label">Status</td>
                <td>: <span style="font-weight:bold; text-transform:uppercase;">{{ $p->status }}</span></td>
            </tr>
        </table>

        <p style="margin-top: 20px;">
            Demikian surat keterangan ini diberikan kepada yang bersangkutan untuk dipergunakan sebagai bukti sah
            keanggotaan dalam organisasi IKS.PI KERA SAKTI.
        </p>
    </div>

    <div class="ttd-container">
        <p>Parung, {{ date('d F Y') }}</p>
        <p style="font-weight: bold;">Ketua Pengurus Cabang</p>
        <div class="ttd-space">Moh Ahlusiyam Ferliansyah</div>
        <div style="font-size: 10px;">NIW. PC-IKSPI.2026</div>
    </div>
</body>

</html>
