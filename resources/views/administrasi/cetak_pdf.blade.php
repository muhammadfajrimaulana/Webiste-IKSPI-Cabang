<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pengesahan Anggota Cabang</title>
    <style>
        /* Dompdf butuh CSS native murni, jangan pake CDN Tailwind di dalam sini ya nyet */
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #0f172a;
            padding: 10px;
        }

        .kop-surat {
            width: 100%;
            border-bottom: 4px solid #0f172a;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .kop-tabel {
            width: 100%;
            text-align: center;
        }

        .judul-organisasi {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
        }

        .sub-judul {
            font-size: 14px;
            font-weight: bold;
            color: #dc2626;
            text-transform: uppercase;
            margin: 5px 0;
        }

        .alamat {
            font-size: 9px;
            color: #64748b;
            margin: 0;
        }

        .judul-dokumen {
            text-center: center;
            margin-top: 20px;
            margin-bottom: 30px;
            text-align: center;
        }

        .judul-dokumen h3 {
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: underline;
            margin: 0;
        }

        .judul-dokumen p {
            font-size: 9px;
            color: #94a3b8;
            margin-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background-color: #f1f5f9;
            border: 1px solid #cbd5e1;
            padding: 8px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            text-align: left;
        }

        td {
            border: 1px solid #cbd5e1;
            padding: 8px;
            font-size: 11px;
        }

        .text-center {
            text-align: center;
        }

        .font-mono {
            font-family: monospace;
            font-weight: bold;
        }

        .ttd-container {
            margin-top: 50px;
            float: right;
            width: 250px;
            text-align: center;
        }

        .ttd-space {
            margin-top: 60px;
            font-weight: bold;
            border-b: 1px solid #0f172a;
            padding-bottom: 3px;
        }

        .niw {
            font-size: 9px;
            color: #94a3b8;
            margin-top: 2px;
        }
    </style>
</head>

<body>

    <div class="kop-surat">
        <table class="kop-tabel">
            <tr>
                <td style="border: none; width: 15%; text-align: center; vertical-align: middle;">
                    <img src="{{ public_path('assets/img/logo-ikspi.png') }}"
                        style="width: 70px; height: auto; max-height: 80px;">
                </td>
                <td style="border: none; width: 70%; text-align: center;">
                    <h1 class="judul-organisasi">Ikatan Keluarga Silat Putra Indonesia</h1>
                    <h2 class="sub-judul">IKS.PI KERA SAKTI CABANG JAKARTA PUSAT</h2>
                    <p class="alamat">Sekretariat Pengurus Cabang • Email: cabangjakpus@ikspi.org • Kontak: +62
                        812-9696-4998
                    </p>
                </td>
                <td style="border: none; width: 15%; font-size: 9px; color: #94a3b8; text-align: center;">
                    DOKUMEN<br>KAS/WARGA
                </td>
            </tr>
        </table>
    </div>

    <div class="judul-dokumen">
        <h3>Laporan Pengesahan Anggota Resmi</h3>
        <p>Generated via System: {{ date('d F Y H:i') }} WIB</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 5%;">No</th>
                <th style="width: 25%;">No. Anggota</th>
                <th>Nama Lengkap Pendekar</th>
                <th style="width: 25%;">Ranting Latihan</th>
                <th style="width: 20%;">Tanggal Sah</th>
            </tr>
        </thead>
        <tbody>
            @forelse($anggotaResmi as $index => $row)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="font-mono" style="color: #dc2626;">{{ $row->nomor_anggota }}</td>
                    <td style="font-weight: bold; text-transform: uppercase;">{{ $row->pendaftaran->nama_lengkap }}</td>
                    <td>{{ $row->ranting->nama_ranting }}</td>
                    <td>{{ $row->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center" style="font-style: italic; color: #64748b; padding: 20px;">
                        Belum ada data warga/anggota yang resmi disahkan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="ttd-container">
        <p style="color: #64748b; margin: 0;">Mengetahui,</p>
        <p style="font-weight: bold; margin: 5px 0 0 0; text-transform: uppercase;">Ketua Pengurus Cabang</p>

        <div class="ttd-space">Moh Ahlusiyam Ferliansyah</div>
        <div class="niw">NIW. PC-IKSPI.2026</div>
    </div>

</body>

</html>
