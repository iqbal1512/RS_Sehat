<div class="page-header">
    <div>
        <h1>Detail Pendaftaran</h1>
        <p>Informasi tiket pendaftaran pasien dan status terkini kunjungan.</p>
    </div>
    <div class="section-actions">
        <a href="<?= base_url('pasien/status') ?>" class="btn btn-outline btn-sm">Kembali ke Status</a>
    </div>
</div>

<?php
if (empty($detail)) {
    echo '<div class="alert alert-danger">Data pendaftaran tidak ditemukan.</div>';
    return;
}

$status = $detail->status ?? 'menunggu';
$detail_id = htmlspecialchars($detail->id ?? '-', ENT_QUOTES, 'UTF-8');
$nama_dokter = htmlspecialchars($detail->nama_dokter ?? '-', ENT_QUOTES, 'UTF-8');
$spesialis = htmlspecialchars($detail->spesialis ?? '-', ENT_QUOTES, 'UTF-8');
$keluhan = !empty($detail->keluhan) ? nl2br(htmlspecialchars($detail->keluhan, ENT_QUOTES, 'UTF-8')) : '<span style="color:var(--text-muted)">-</span>';
$catatan_admin = !empty($detail->catatan_admin) ? nl2br(htmlspecialchars($detail->catatan_admin, ENT_QUOTES, 'UTF-8')) : '';
$tanggal_kunjungan = !empty($detail->tanggal_kunjungan) ? date('d F Y', strtotime($detail->tanggal_kunjungan)) : '-';
$jam_kunjungan = !empty($detail->jam_kunjungan) ? date('H:i', strtotime($detail->jam_kunjungan)) . ' WIB' : '-';
$tanggal_daftar = !empty($detail->created_at) ? date('d M Y H:i', strtotime($detail->created_at)) : '-';
$note_bg = $status == 'disetujui' ? '47,133,90' : ($status == 'ditolak' ? '197,48,48' : '43,108,176');
$note_border = $status == 'disetujui' ? 'var(--accent-green)' : ($status == 'ditolak' ? 'var(--accent-red)' : 'var(--accent-blue)');
$note_icon_color = $status == 'disetujui' ? 'var(--accent-green)' : ($status == 'ditolak' ? 'var(--accent-red)' : 'var(--accent-blue)');
?>

<!-- #printArea membungkus SEMUA yang perlu ikut tercetak (card utama + sidebar).
     CATATAN PENTING: max-width:900px DIHAPUS dari sini. Beranda (dash-grid,
     middle-row) full-width mengikuti .patient-content, jadi halaman ini pun
     harus full-width yang sama, bukan dibatasi sendiri secara terpisah. -->
<div id="printArea" class="detail-layout">
    <div class="ticket-card">
        <div class="card glass fade-in" id="cardUtama" style="padding:0">
            <!-- Header dengan Status -->
            <div class="no-split" style="border-bottom:1px solid rgba(255,255,255,0.3); padding:24px; display:flex; justify-content:space-between; align-items:center">
                <div style="display:flex; align-items:center; gap:12px">
                    <div class="stat-icon-wrapper" style="background:rgba(43,108,176,0.2); color:var(--accent-blue)"><i class="fas fa-file-medical"></i></div>
                    <h5 style="margin:0; color:var(--text-main); font-weight:800; font-size:16px">Tiket Pendaftaran #<?= $detail_id ?></h5>
                </div>
                <?php if($status == 'disetujui'): ?>
                    <span style="background:linear-gradient(135deg, rgba(47,133,90,0.3), rgba(47,133,90,0.1)); color:var(--accent-green); border:1px solid var(--accent-green); font-weight:700; font-size:12px; padding:8px 16px; border-radius:var(--radius-pill); display:inline-flex; align-items:center; gap:6px"><i class="fas fa-check-circle"></i> Disetujui</span>
                <?php elseif($status == 'ditolak'): ?>
                    <span style="background:linear-gradient(135deg, rgba(197,48,48,0.3), rgba(197,48,48,0.1)); color:var(--accent-red); border:1px solid var(--accent-red); font-weight:700; font-size:12px; padding:8px 16px; border-radius:var(--radius-pill); display:inline-flex; align-items:center; gap:6px"><i class="fas fa-times-circle"></i> Ditolak</span>
                <?php else: ?>
                    <span style="background:linear-gradient(135deg, rgba(43,108,176,0.3), rgba(43,108,176,0.1)); color:var(--accent-blue); border:1px solid var(--accent-blue); font-weight:700; font-size:12px; padding:8px 16px; border-radius:var(--radius-pill); display:inline-flex; align-items:center; gap:6px"><i class="fas fa-hourglass-end"></i> Menunggu Review</span>
                <?php endif; ?>
            </div>

            <!-- Catatan Admin -->
            <?php if (!empty($catatan_admin)): ?>
            <div class="no-split" style="padding:20px 24px; border-bottom:1px solid rgba(255,255,255,0.3); background:rgba(<?= $note_bg ?>,0.08); border-left:4px solid <?= $note_border ?>">
                <div style="display:flex; gap:12px; align-items:flex-start">
                    <i class="fas fa-comment" style="color:<?= $note_icon_color ?>; margin-top:2px; font-size:16px"></i>
                    <div>
                        <strong style="display:block; margin-bottom:6px; color:var(--text-main); font-size:13px; text-transform:uppercase; letter-spacing:0.5px">Catatan Admin</strong>
                        <p style="margin:0; color:var(--text-muted); font-size:14px; line-height:1.6"><?= $catatan_admin ?></p>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Detail Informasi -->
            <div style="padding:32px">
                <div class="no-split" style="display:grid; grid-template-columns:1fr 1fr; gap:32px; margin-bottom:32px">
                    <!-- Dokter -->
                    <div>
                        <div style="font-weight:700; font-size:12px; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:12px">Dokter Spesialis</div>
                        <h4 style="margin:0 0 8px; color:var(--text-main); font-size:16px; font-weight:800"><?= $nama_dokter ?></h4>
                        <span style="display:inline-block; background:rgba(43,108,176,0.15); color:var(--accent-blue); padding:4px 12px; border-radius:var(--radius-pill); font-size:12px; font-weight:600"><?= $spesialis ?></span>
                    </div>

                    <!-- Jadwal -->
                    <div>
                        <div style="font-weight:700; font-size:12px; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:12px">Jadwal Kunjungan</div>
                        <div style="display:flex; flex-direction:column; gap:8px">
                            <div style="display:flex; align-items:center; gap:8px; color:var(--text-main); font-weight:600; font-size:14px">
                                <i class="far fa-calendar-alt" style="color:var(--accent-blue); width:16px; text-align:center"></i> <?= $tanggal_kunjungan ?>
                            </div>
                            <div style="display:flex; align-items:center; gap:8px; color:var(--text-main); font-weight:600; font-size:14px">
                                <i class="far fa-clock" style="color:var(--accent-green); width:16px; text-align:center"></i> <?= $jam_kunjungan ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Keluhan -->
                <div class="no-split" style="padding:24px; background:rgba(255,255,255,0.2); border-radius:var(--radius-md); border:1px solid rgba(255,255,255,0.3)">
                    <div style="font-weight:700; font-size:12px; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:12px">Keluhan / Gejala Penyakit</div>
                    <p style="margin:0; color:var(--text-main); font-size:14px; line-height:1.8"><?= $keluhan ?></p>
                </div>

                <!-- Action Buttons (disembunyikan saat print lewat class no-print) -->
                <div class="no-print" style="margin-top:32px; padding-top:24px; border-top:1px solid rgba(255,255,255,0.3); display:flex; gap:12px; justify-content:center">
                    <?php if ($status === 'disetujui'): ?>
                        <button onclick="window.print()" class="btn glass-pill" style="padding:12px 24px; font-weight:700; background:linear-gradient(135deg, var(--accent-green), rgba(47,133,90,0.8)); color:#fff; box-shadow:0 6px 20px rgba(47,133,90,0.3); border:1px solid rgba(255,255,255,0.3)"><i class="fas fa-print"></i> Cetak Bukti</button>
                        <button onclick="alert('Tunjukkan bukti ini kepada petugas pendaftaran saat datang.')" class="btn glass-pill" style="padding:12px 24px; font-weight:700; background:linear-gradient(135deg, var(--accent-blue), rgba(43,108,176,0.8)); color:#fff; box-shadow:0 6px 20px rgba(43,108,176,0.3); border:1px solid rgba(255,255,255,0.3); cursor:pointer"><i class="fas fa-info-circle"></i> Info Lebih Lanjut</button>
                    <?php else: ?>
                        <div style="text-align:center; color:var(--text-muted); font-size:13px">
                            <p style="margin:0"><i class="fas fa-info-circle" style="margin-right:6px; color:var(--accent-blue)"></i>Bukti cetak tersedia setelah status disetujui</p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Footer khusus cetak: muncul HANYA saat print -->
                <div class="print-only" style="display:none; margin-top:24px; padding-top:16px; border-top:1px solid #ddd; font-size:11px; color:#666; text-align:center">
                    Dicetak melalui sistem pendaftaran RS &mdash; <?= date('d F Y H:i') ?> WIB
                </div>
            </div>
        </div>
    </div>

    <!-- Info Sidebar -->
    <div class="side-card">
        <div class="card glass fade-in" id="cardSidebar" style="padding:24px; display:flex; flex-direction:column; gap:20px">
            <div class="no-split">
                <div style="font-weight:700; font-size:12px; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:8px">Nomor Tiket</div>
                <p style="margin:0; color:var(--text-main); font-weight:700; font-size:18px">#<?= str_pad($detail->id ?? 0, 6, '0', STR_PAD_LEFT) ?></p>
            </div>

            <hr style="border:none; border-top:1px solid rgba(255,255,255,0.2); margin:0">

            <div class="no-split">
                <div style="font-weight:700; font-size:12px; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:8px">Tanggal Daftar</div>
                <p style="margin:0; color:var(--text-main); font-weight:600; font-size:13px"><?= $tanggal_daftar ?></p>
            </div>

            <hr style="border:none; border-top:1px solid rgba(255,255,255,0.2); margin:0">

            <div class="no-split">
                <div style="font-weight:700; font-size:12px; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:8px">Status Saat Ini</div>
                <div style="display:flex; align-items:center; gap:6px">
                    <?php if($status == 'disetujui'): ?>
                        <i class="fas fa-check-circle" style="color:var(--accent-green); font-size:16px"></i>
                        <span style="color:var(--accent-green); font-weight:700; font-size:13px">Disetujui</span>
                    <?php elseif($status == 'ditolak'): ?>
                        <i class="fas fa-times-circle" style="color:var(--accent-red); font-size:16px"></i>
                        <span style="color:var(--accent-red); font-weight:700; font-size:13px">Ditolak</span>
                    <?php else: ?>
                        <i class="fas fa-hourglass-end" style="color:var(--accent-blue); font-size:16px"></i>
                        <span style="color:var(--accent-blue); font-weight:700; font-size:13px">Menunggu</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* =========================================================
   PRINT STYLESHEET
   Prinsip: TIDAK ADA position:absolute sama sekali.
   Semua card mengikuti flow normal (block, satu kolom),
   sehingga tidak akan pernah saling tertindih.
   ========================================================= */
@media print {

    .sidebar,
    .top-nav,
    .page-header,
    .no-print {
        display: none !important;
    }

    .print-only {
        display: block !important;
    }

    body {
        background: #fff !important;
    }

    .main-area,
    .patient-wrapper,
    .patient-content {
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    /* Wrapper dari grid 2-kolom menjadi 1 kolom vertikal saat print */
    #printArea {
        display: block !important;
        max-width: 100% !important;
        gap: 0 !important;
    }

    #printArea > div {
        width: 100% !important;
        flex: none !important;
    }

    .card.glass {
        background: #fff !important;
        backdrop-filter: none !important;
        -webkit-backdrop-filter: none !important;
        box-shadow: none !important;
        border: 1px solid #e2e2e2 !important;
        border-radius: 12px !important;
        position: static !important;
        page-break-inside: avoid;
        break-inside: avoid;
    }

    #cardUtama {
        margin-bottom: 20px;
    }

    #cardSidebar {
        margin-top: 0;
    }

    .no-split {
        page-break-inside: avoid;
        break-inside: avoid;
    }

    .card, .card * {
        color: #1a202c !important;
    }

    .card [style*="color:var(--accent-green)"] { color: #2f855a !important; }
    .card [style*="color:var(--accent-red)"]   { color: #c53030 !important; }
    .card [style*="color:var(--accent-blue)"]  { color: #2b6cb0 !important; }

    a { text-decoration: none !important; }
}

.print-only {
    display: none;
}
</style>