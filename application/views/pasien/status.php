<div class="page-header">
    <div>
        <h1>Status Pendaftaran</h1>
        <p>Pantau status pendaftaran berobat Anda secara real time.</p>
    </div>
    <div class="section-actions">
        <a href="<?= base_url('pasien/daftar') ?>" class="btn btn-success btn-sm">Daftar Baru</a>
        <a href="<?= base_url('pasien') ?>" class="btn btn-outline btn-sm">Beranda</a>
    </div>
</div>
<div class="card glass fade-in" style="padding:0; overflow:hidden">
    <div class="card-header" style="border-bottom:1px solid rgba(255,255,255,0.3); padding:24px; display:flex; align-items:center; gap:12px">
        <div class="stat-icon-wrapper" style="background:rgba(47,133,90,0.2); color:var(--accent-green)"><i class="fas fa-clipboard-check"></i></div>
        <h5 style="margin:0; color:var(--text-main); font-weight:800; font-size:18px">Riwayat Pendaftaran Anda</h5>
    </div>
    <div class="card-body" style="padding:0">
        <div class="table-wrapper" style="padding:24px; overflow-x:auto">
            <?php if (!empty($pendaftaran)): ?>
            <table class="table" style="width:100%">
                <thead>
                    <tr style="border-bottom:2px solid rgba(255,255,255,0.3)">
                        <th style="padding:12px; text-align:left; font-weight:700; font-size:13px; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px">Tgl Daftar</th>
                        <th style="padding:12px; text-align:left; font-weight:700; font-size:13px; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px">Dokter & Spesialis</th>
                        <th style="padding:12px; text-align:left; font-weight:700; font-size:13px; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px">Jadwal Kunjungan</th>
                        <th style="padding:12px; text-align:left; font-weight:700; font-size:13px; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px">Status</th>
                        <th style="padding:12px; text-align:center; font-weight:700; font-size:13px; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pendaftaran as $p): ?>
                    <tr style="border-bottom:1px solid rgba(255,255,255,0.2); transition:background 0.2s">
                        <td style="padding:16px 12px">
                            <strong style="color:var(--text-main); font-size:14px; display:block"><?= date('d M Y', strtotime($p->created_at)) ?></strong>
                            <small style="color:var(--text-muted); font-size:12px"><?= date('H:i', strtotime($p->created_at)) ?></small>
                        </td>
                        <td style="padding:16px 12px">
                            <strong style="color:var(--text-main); font-size:14px; display:block"><?= htmlspecialchars($p->nama_dokter) ?></strong>
                            <small style="color:var(--text-muted); font-size:12px; display:inline-block; margin-top:4px; padding:2px 8px; background:rgba(255,255,255,0.2); border-radius:var(--radius-pill)"><?= htmlspecialchars($p->spesialis) ?></small>
                        </td>
                        <td style="padding:16px 12px">
                            <div style="font-size:13px; color:var(--text-main); font-weight:600; display:flex; align-items:center; gap:6px; margin-bottom:4px">
                                <i class="far fa-calendar-alt" style="color:var(--accent-blue)"></i> <?= date('d M Y', strtotime($p->tanggal_kunjungan)) ?>
                            </div>
                            <div style="font-size:13px; color:var(--text-main); font-weight:600; display:flex; align-items:center; gap:6px">
                                <i class="far fa-clock" style="color:var(--accent-blue)"></i> <?= date('H:i', strtotime($p->jam_kunjungan)) ?>
                            </div>
                        </td>
                        <td style="padding:16px 12px">
                            <?php if($p->status == 'disetujui'): ?>
                                <span class="badge" style="background:linear-gradient(135deg, rgba(47,133,90,0.3), rgba(47,133,90,0.1)); color:var(--accent-green); border:1px solid var(--accent-green); font-weight:700; font-size:12px; padding:6px 12px; border-radius:var(--radius-pill); display:inline-flex; align-items:center; gap:6px"><i class="fas fa-check-circle"></i> Disetujui</span>
                            <?php elseif($p->status == 'ditolak'): ?>
                                <span class="badge" style="background:linear-gradient(135deg, rgba(197,48,48,0.3), rgba(197,48,48,0.1)); color:var(--accent-red); border:1px solid var(--accent-red); font-weight:700; font-size:12px; padding:6px 12px; border-radius:var(--radius-pill); display:inline-flex; align-items:center; gap:6px"><i class="fas fa-times-circle"></i> Ditolak</span>
                            <?php else: ?>
                                <span class="badge" style="background:linear-gradient(135deg, rgba(43,108,176,0.3), rgba(43,108,176,0.1)); color:var(--accent-blue); border:1px solid var(--accent-blue); font-weight:700; font-size:12px; padding:6px 12px; border-radius:var(--radius-pill); display:inline-flex; align-items:center; gap:6px"><i class="fas fa-hourglass-end"></i> Menunggu</span>
                            <?php endif; ?>
                        </td>
                        <td style="padding:16px 12px; text-align:center">
                            <a href="<?= base_url('pasien/detail/'.$p->id) ?>" class="btn glass-pill" style="padding:8px 14px; font-size:13px; font-weight:600; text-decoration:none; display:inline-block; background:linear-gradient(135deg, var(--accent-blue), rgba(43,108,176,0.8)); color:#fff; box-shadow:0 4px 12px rgba(43,108,176,0.25); border:1px solid rgba(255,255,255,0.3)" title="Lihat Detail">
                                <i class="fas fa-arrow-right"></i> Detail
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div style="text-align:center; padding:60px 24px; color:var(--text-muted)">
                <div style="font-size:48px; margin-bottom:16px"><i class="fas fa-inbox"></i></div>
                <h6 style="margin:0 0 8px; font-size:16px; font-weight:700; color:var(--text-main)">Belum Ada Pendaftaran</h6>
                <p style="margin:0; font-size:14px">Anda belum membuat pendaftaran berobat. <a href="<?= base_url('pasien/daftar') ?>" style="color:var(--accent-blue); text-decoration:none; font-weight:600">Mulai daftar sekarang</a></p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
