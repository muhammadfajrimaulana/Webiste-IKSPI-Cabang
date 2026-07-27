<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pengesahan Anggota IKSPI Cabang Jakarta Pusat</title>
    <style>
        @page {
            size: A4;
            margin: 15mm 15mm 15mm 15mm;
        }

        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #0f172a;
            padding: 0;
            margin: 0;
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
            background-color: #0f172a;
            color: #ffffff;
            border: 1px solid #0f172a;
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

        @page {
            margin: 20mm 15mm 20mm 15mm;
        }

        .page-number:before {
            content: counter(page);
        }

        .total-pages:before {
            content: counter(pages);
        }
    </style>
</head>

<body>

    <div class="kop-surat">
        <table class="kop-tabel">
            <tr>
                <td style="border: none; width: 15%; text-align: center; vertical-align: middle;">
                    <img src="{{ public_path('assets/img/ikspi-jakpus.png') }}"
                        style="width: 70px; height: auto; max-height: 80px;">
                </td>
                <td style="border: none; width: 70%; text-align: center;">
                    <h1 class="judul-organisasi">Ikatan Keluarga Silat Putra Indonesia</h1>
                    <h2 class="sub-judul">IKS.PI KERA SAKTI CABANG JAKARTA PUSAT</h2>
                    <p class="alamat">Sekretariat Pengurus Cabang • Email: cabangjakpus@ikspi.org • Kontak: +62
                        812-9696-4998
                    </p>
                </td>
                <td style="border: none; width: 15%; text-align: center; vertical-align: middle;">
                    <img src="{{ public_path('assets/img/ikspi.png') }}"
                        style="width: 70px; height: auto; max-height: 80px;">
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
                <th class="text-center" style="width: 12%;">Pas Foto</th>
                <th style="width: 20%;">No. Anggota</th>
                <th>Nama Lengkap</th>
                <th style="width: 20%;">Ranting Latihan</th>
                <th style="width: 20%;">Tanggal Disahkan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($anggotaResmi as $index => $row)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">
                        @php
                            $fotoPath = null;
                            if ($row->pendaftaran?->pas_foto) {
                                if (Str::startsWith($row->pendaftaran->pas_foto, 'http')) {
                                    $fotoPath = $row->pendaftaran->pas_foto;
                                } else {
                                    // Menggunakan path fisik server agar terbaca oleh PDF generator
                                    $localPath = public_path('storage/' . $row->pendaftaran->pas_foto);
                                    if (file_exists($localPath)) {
                                        $fotoPath = $localPath;
                                    }
                                }
                            }

                            // Jika tidak ada atau file tidak ditemukan, arahkan ke default
                            if (
                                !$fotoPath ||
                                (is_string($fotoPath) && !Str::startsWith($fotoPath, 'http') && !file_exists($fotoPath))
                            ) {
                                $fotoPath = public_path('images/default.png');
                            }
                        @endphp

                        <img src="{{ $fotoPath }}" alt="Pas Foto" width="45"
                            style="width: 45px; height: 45px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1;">
                    </td>
                    <td class="font-mono" style="color: #dc2626;">{{ $row->nomor_anggota }}</td>
                    <td style="font-weight: bold; text-transform: uppercase;">{{ $row->pendaftaran->nama_lengkap }}</td>
                    <td>{{ $row->ranting->nama_ranting }}</td>
                    <td>{{ $row->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center" style="font-style: italic; color: #64748b; padding: 20px;">
                        {{ request('ranting_id') ? 'Belum ada data anggota resmi untuk ranting yang dipilih.' : 'Belum ada data anggota yang resmi disahkan.' }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="ttd-container">
        <p style="color: #64748b; margin: 0;">Mengetahui,</p>
        <p class="ttd-title" style="margin: 5px 0 0 0;">Ketua Cabang Jakarta Pusat</p>
        <div class="ttd-space">( ........................................ )</div>
        <div style="font-size: 9px; color: #94a3b8; margin-top: 2px;">NIW.
            ........................................</div>
    </div>

    <div style="position: fixed; bottom: -10mm; left: 0; right: 0; text-align: center; font-size: 9px; color: #94a3b8;">
        Halaman <span class="page-number"></span> dari <span class="total-pages"></span>
    </div>
</body>

</html>
