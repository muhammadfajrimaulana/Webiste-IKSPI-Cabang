<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan {{ $ranting ? '' . $ranting->nama_ranting : 'Semua Ranting' }} IKSPI Cabang
        Jakarta Pusat</title>
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
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
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

        /* Kotak Informasi Filter / Meta Data */
        .info-box {
            width: 100%;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 11px;
        }

        .info-box table {
            width: 100%;
            margin-top: 0;
        }

        .info-box td {
            border: none;
            padding: 2px 5px;
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

        .text-right {
            text-align: right;
        }

        .font-mono {
            font-family: monospace;
            font-weight: bold;
        }

        /* Label Tipe Transaksi */
        .badge-masuk {
            color: #059669;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
        }

        .badge-keluar {
            color: #dc2626;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
        }

        /* Tabel Ringkasan Saldo */
        .summary-container {
            width: 100%;
            margin-top: 15px;
            margin-bottom: 30px;
        }

        .summary-box {
            background-color: #0f172a;
            color: #ffffff;
            padding: 10px 15px;
            text-align: right;
            border-radius: 4px;
        }

        /* Area Tanda Tangan Ganda (Ketua & Bendahara) */
        .ttd-wrapper {
            width: 100%;
            margin-top: 30px;
        }

        .ttd-table {
            width: 100%;
            border: none;
        }

        .ttd-table td {
            border: none;
            text-align: center;
            vertical-align: top;
            width: 50%;
        }

        .ttd-space {
            margin-top: 60px;
            font-weight: bold;
            text-decoration: underline;
        }

        .ttd-title {
            font-weight: bold;
            text-transform: uppercase;
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

    <!-- Kop Surat -->
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
                        812-9696-4998</p>
                </td>
                <td style="border: none; width: 15%; text-align: center; vertical-align: middle;">
                    <img src="{{ public_path('assets/img/ikspi-jakpus.png') }}"
                        style="width: 70px; height: auto; max-height: 80px;">
                </td>
            </tr>
        </table>
    </div>

    <!-- Judul Dokumen -->
    <div class="judul-dokumen">
        <h3>Laporan Keuangan Administrasi Organisasi</h3>
        <p>Generated via System: {{ date('d F Y H:i') }} WIB</p>
    </div>

    <!-- Informasi Filter / Meta Data -->
    <div class="info-box">
        <table>
            <tr>
                <td style="width: 12%; font-weight: bold; color: #64748b;">Ranting:</td>
                <td style="width: 38%;">{{ $ranting ? $ranting->nama_ranting : 'Semua Ranting / Cabang Utama' }}</td>
                <td style="width: 12%; font-weight: bold; color: #64748b;">Kategori:</td>
                <td style="width: 38%; text-transform: uppercase; font-weight: bold;">
                    {{ request('kategori') ?: 'Semua Kategori' }}
                </td>
            </tr>
        </table>
    </div>

    <!-- Tabel Data Transaksi -->
    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 5%;">No</th>
                <th style="width: 15%;">Tanggal</th>
                <th>Kategori</th>
                <th>Keterangan</th>
                <th style="width: 15%;">Tipe Transaksi</th>
                <th class="text-right" style="width: 25%;">Nominal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksi as $index => $item)
                <tr>
                    <td class="text-center" style="color: #64748b;">{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                    <td style="font-weight: bold;">{{ $item->kategori }}</td>
                    <td style="font-weight: bold;">{{ $item->keterangan }}</td>
                    <td>
                        <span class="{{ $item->tipe == 'masuk' ? 'badge-masuk' : 'badge-keluar' }}">
                            {{ ucfirst($item->tipe) }}
                        </span>
                    </td>
                    <td class="text-right font-mono"
                        style="color: {{ $item->tipe == 'masuk' ? '#059669' : '#dc2626' }};">
                        {{ $item->tipe == 'masuk' ? '+' : '-' }} Rp {{ number_format($item->nominal, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center" style="font-style: italic; color: #64748b; padding: 20px;">
                        Tidak ada data transaksi yang ditemukan sesuai filter.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Hitung Total -->
    @php
        $totalMasuk = $transaksi->where('tipe', 'masuk')->sum('nominal');
        $totalKeluar = $transaksi->where('tipe', 'keluar')->sum('nominal');
        $saldoAkhir = $totalMasuk - $totalKeluar;
    @endphp

    <!-- Ringkasan Total & Saldo -->
    <table style="margin-top: 15px; border: none;">
        <tr>
            <td style="border: none; width: 50%; vertical-align: top; font-size: 11px;">
                <p style="margin: 4px 0; color: #64748b;">Total Pemasukan: <span
                        style="font-weight: bold; color: #059669;">Rp
                        {{ number_format($totalMasuk, 0, ',', '.') }}</span></p>
                <p style="margin: 4px 0; color: #64748b;">Total Pengeluaran: <span
                        style="font-weight: bold; color: #dc2626;">Rp
                        {{ number_format($totalKeluar, 0, ',', '.') }}</span></p>
            </td>
            <td style="border: none; width: 50%; vertical-align: top; text-align: right;">
                <div
                    style="background-color: #0f172a; color: #ffffff; padding: 8px 12px; display: inline-block; text-align: right;">
                    <span style="font-size: 9px; text-transform: uppercase; color: #94a3b8; display: block;">Saldo
                        Bersih / Sisa</span>
                    <span style="font-size: 13px; font-weight: bold;">Rp
                        {{ number_format($saldoAkhir, 0, ',', '.') }}</span>
                </div>
            </td>
        </tr>
    </table>

    <!-- Tanda Tangan Pengurus (Ketua & Bendahara) -->
    <div class="ttd-wrapper">
        <table class="ttd-table">
            <tr>
                <td>
                    <p style="color: #64748b; margin: 0;">Mengetahui,</p>
                    <p class="ttd-title" style="margin: 5px 0 0 0;">Ketua Cabang Jakarta Pusat</p>
                    <div class="ttd-space">( ........................................ )</div>
                    <div style="font-size: 9px; color: #94a3b8; margin-top: 2px;">NIW.
                        ........................................</div>
                </td>
                <td>
                    <p style="color: #64748b; margin: 0;">Jakarta Pusat, {{ date('d F Y') }}</p>
                    <p class="ttd-title" style="margin: 5px 0 0 0;">Bendahara Cabang</p>
                    <div class="ttd-space">( ........................................ )</div>
                    <div style="font-size: 9px; color: #94a3b8; margin-top: 2px;">NIW.
                        ........................................</div>
                </td>
            </tr>
        </table>
    </div>

    <div style="position: fixed; bottom: -10mm; left: 0; right: 0; text-align: center; font-size: 9px; color: #94a3b8;">
        Halaman <span class="page-number"></span> dari <span class="total-pages"></span>
    </div>
</body>

</html>
