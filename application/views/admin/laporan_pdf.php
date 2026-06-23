<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h2 { margin: 0 0 5px 0; }
        .header p { margin: 0; color: #666; }
        .info { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th { background-color: #f5f5f5; padding: 8px; text-align: left; }
        td { padding: 8px; }
        .text-center { text-align: center; }
        .footer { text-align: right; margin-top: 40px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="no-print" style="margin-bottom:20px; text-align:center">
        <button onclick="window.print()" style="padding:10px 20px; cursor:pointer; background:#0891b2; color:#fff; border:none; border-radius:5px;">Cetak / Simpan PDF</button>
    </div>

    <div class="header">
        <h2>RS Sehat Sejahtera</h2>
        <p>Jl. Kesehatan No. 123, Kota Sehat</p>
        <p>Telp: (021) 1234567 | Email: info@rssehatsejahtera.com</p>
    </div>

    <div class="info">
        <h3 style="margin:0 0 10px 0; text-align:center; text-transform:uppercase"><?= $title ?></h3>
        <p><strong>Periode:</strong> <?= $start_date ? date('d M Y', strtotime($start_date)) : 'Awal' ?> s/d <?= $end_date ? date('d M Y', strtotime($end_date)) : 'Sekarang' ?></p>
        <p><strong>Tanggal Cetak:</strong> <?= date('d M Y H:i:s') ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="15%">Tanggal Daftar</th>
                <th width="20%">Nama Pasien</th>
                <th width="20%">Dokter Spesialis</th>
                <th width="15%">Jadwal Kunjungan</th>
                <th width="15%">Keluhan</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($report_data)): ?>
            <tr><td colspan="7" class="text-center">Tidak ada data pendaftaran</td></tr>
            <?php else: $no = 1; foreach ($report_data as $r): ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= date('d-m-Y H:i', strtotime($r->created_at)) ?></td>
                <td>
                    <strong><?= htmlspecialchars($r->nama_pasien) ?></strong><br>
                    <?= htmlspecialchars($r->nomor_telepon) ?>
                </td>
                <td>
                    <?= htmlspecialchars($r->nama_dokter) ?><br>
                    <small>(<?= htmlspecialchars($r->spesialis) ?>)</small>
                </td>
                <td>
                    <?= date('d-m-Y', strtotime($r->tanggal_kunjungan)) ?><br>
                    <?= date('H:i', strtotime($r->jam_kunjungan)) ?> WIB
                </td>
                <td><?= htmlspecialchars($r->keluhan) ?></td>
                <td><?= ucfirst($r->status) ?></td>
            </tr>
            <?php endforeach; endif; ?>
        </tbody>
    </table>

    <div class="footer">
        <p>Mengetahui,</p>
        <br><br><br>
        <p><strong>Admin RS Sehat Sejahtera</strong></p>
    </div>
</body>
</html>
