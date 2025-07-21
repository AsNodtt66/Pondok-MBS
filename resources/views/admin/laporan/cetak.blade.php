<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - Pondok Pesantren MBS</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #003087;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            border-bottom: 5px solid #0047AB;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 14px;
        }
        .content {
            padding: 30px;
        }
        .section-title {
            color: #003087;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
            border-bottom: 2px solid #0047AB;
            padding-bottom: 5px;
        }
        .details-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }
        .details-table td {
            padding: 10px 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            font-size: 14px;
        }
        .details-table td:first-child {
            font-weight: bold;
            color: #003087;
            width: 30%;
            text-align: right;
            background-color: #e6ecf5;
        }
        .data-section {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #e9f0fa;
            border-left: 4px solid #0047AB;
            border-radius: 8px;
        }
        .status {
            font-size: 16px;
            font-weight: bold;
            color: #0047AB;
            margin-top: 20px;
            text-align: center;
            padding: 10px;
            background-color: #e6ecf5;
            border-radius: 8px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #003087;
            color: #ffffff;
            font-size: 14px;
            margin-top: 20px;
            border-top: 2px solid #0047AB;
        }
        .footer p {
            margin: 5px 0;
        }
        .buttons {
            text-align: center;
            margin-top: 20px;
        }
        .btn {
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            color: #ffffff;
        }
        .btn-print {
            background-color: #0047AB;
        }
        .btn-print:hover {
            background-color: #003087;
        }
        .btn-back {
            background-color: #6c757d;
        }
        .btn-back:hover {
            background-color: #5a6268;
        }
        @media print {
            .no-print {
                display: none;
            }
            .container {
                box-shadow: none;
                width: 100%;
                margin: 0;
                border-radius: 0;
            }
            .header {
                border-bottom: 2px solid #0047AB;
            }
            .footer {
                border-top: 2px solid #0047AB;
            }
            .btn {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Laporan Pondok Pesantren MBS</h1>
            <p>Laporan Number : LAP-{{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</p>
        </div>
        <div class="content">
            <div class="section-title">Bukti Laporan</div>
            <table class="details-table">
                <tr>
                    <td>Nama Santri</td>
                    <td>{{ $laporan->santri->Nama_santri ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Tanggal Laporan</td>
                    <td>{{ $laporan->Tanggal_lapor ? $laporan->Tanggal_lapor->format('d M Y') : '-' }}</td>
                </tr>
                <tr>
                    <td>Jenis Laporan</td>
                    <td>{{ $laporan->Jenis_laporan ?? '-' }}</td>
                </tr>
            </table>

            @if($laporan->psikologiSantri)
                <div class="data-section">
                    <div class="section-title">Data Psikologi</div>
                    <table class="details-table">
                        <tr>
                            <td>Tanggal Konseling</td>
                            <td>{{ $laporan->psikologiSantri->Tanggal_konseling ? $laporan->psikologiSantri->Tanggal_konseling->format('d M Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Hasil Psikologi</td>
                            <td>{{ $laporan->psikologiSantri->Hasil_psikologi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td>{{ $laporan->psikologiSantri->Catatan ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            @endif

            @if($laporan->pembayaran)
                <div class="data-section">
                    <div class="section-title">Data Keuangan</div>
                    <table class="details-table">
                        <tr>
                            <td>Jenis Pembayaran</td>
                            <td>{{ $laporan->pembayaran->Jenis_pembayaran ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td>{{ "Rp. " . number_format($laporan->pembayaran->Jumlah, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Bayar</td>
                            <td>{{ $laporan->pembayaran->Tanggal_bayar ? $laporan->pembayaran->Tanggal_bayar->format('d M Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Status Bayar</td>
                            <td>{{ $laporan->pembayaran->Status_bayar ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            @endif

            @if($laporan->progressHafalan)
                <div class="data-section">
                    <div class="section-title">Data Hafalan</div>
                    <table class="details-table">
                        <tr>
                            <td>Surah</td>
                            <td>{{ $laporan->progressHafalan->Surah ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Ayat Mulai</td>
                            <td>{{ $laporan->progressHafalan->Ayat_mulai ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Ayat Selesai</td>
                            <td>{{ $laporan->progressHafalan->Ayat_selesai ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Setor</td>
                            <td>{{ $laporan->progressHafalan->Tanggal_setor ? $laporan->progressHafalan->Tanggal_setor->format('d M Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Status Setor</td>
                            <td>{{ $laporan->progressHafalan->Status_setor ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            @endif

            <div class="status">
                Status Laporan : {{ $laporan->status ?? 'Belum Diproses' }}
            </div>
        </div>
        <div class="footer">
            <p>Pondok Pesantren MBS</p>
            <p>Terima kasih telah mengelola laporan ini.</p>
        </div>
        <div class="buttons no-print">
            <button class="btn btn-print" onclick="window.print()">Cetak Laporan</button>
            <a href="{{ url()->previous() }}" class="btn btn-back">Kembali</a>
        </div>
    </div>
</body>
</html>