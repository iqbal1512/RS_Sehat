    <div class="page-header">
        <div>
            <h1>Selamat Datang, <?= htmlspecialchars($pasien->nama) ?>!</h1>
            <p>Portal pasien RS Sehat untuk daftar berobat, cek status, dan melihat riwayat pendaftaran.</p>
        </div>
        <div class="section-actions">
            <a href="<?= base_url('pasien/daftar') ?>" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Daftar Baru</a>
            <a href="<?= base_url('pasien/status') ?>" class="btn btn-outline btn-sm">Lihat Status</a>
        </div>
    </div>
    <div class="dash-grid mb-4">
    <div class="stat-card glass" style="grid-column: span 2; background:linear-gradient(135deg, rgba(255,255,255,0.45) 0%, rgba(255,255,255,0.15) 100%); backdrop-filter:blur(25px); border:1px solid rgba(255,255,255,0.3)">
        <div style="display:flex; align-items:center; gap:24px">
            <div style="width:72px; height:72px; border-radius:24px; background:linear-gradient(135deg, var(--accent-blue), rgba(43,108,176,0.8)); display:flex; align-items:center; justify-content:center; color:#fff; font-size:32px; box-shadow:0 8px 20px rgba(43,108,176,0.3)">
                <i class="fas fa-heartbeat"></i>
            </div>
            <div>
                <h3 style="font-size:24px; font-weight:800; margin-bottom:4px; color:var(--text-main)">Selamat datang, <?= htmlspecialchars($pasien->nama) ?>! 👋</h3>
                <p style="color:var(--text-muted); font-weight:500; font-size:14px">Portal layanan kesehatan RS Sehat. Silakan pilih menu untuk mulai.</p>
            </div>
        </div>
    </div>
    
    <div class="stat-card glass" style="background:linear-gradient(135deg, rgba(255,255,255,0.45) 0%, rgba(255,255,255,0.15) 100%); backdrop-filter:blur(25px); border:1px solid rgba(255,255,255,0.3)">
        <div style="display:flex; flex-direction:column; gap:12px">
            <div style="display:flex; align-items:center; gap:12px; margin-bottom:8px">
                <div class="stat-icon-wrapper" style="background:rgba(43,108,176,0.2); color:var(--accent-blue); width:40px; height:40px"><i class="fas fa-user-circle"></i></div>
                <div style="font-weight:700; font-size:12px; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px">Profil Pasien</div>
            </div>
            <div style="padding-left:52px">
                <p style="margin:0 0 4px; font-size:13px; color:var(--text-muted)">No. Telepon</p>
                <p style="margin:0 0 12px; font-size:14px; font-weight:700; color:var(--text-main)"><?= htmlspecialchars($pasien->nomor_telepon) ?></p>
                <p style="margin:0 0 4px; font-size:13px; color:var(--text-muted)">Tanggal Lahir</p>
                <p style="margin:0 0 12px; font-size:14px; font-weight:700; color:var(--text-main)"><?= date('d M Y', strtotime($pasien->tanggal_lahir)) ?></p>
                <p style="margin:0; font-size:11px; color:var(--text-muted)">Bergabung: <?= date('d M Y', strtotime($pasien->created_at)) ?></p>
            </div>
        </div>
    </div>
    
    <div class="stat-card glass" style="align-items:center; text-align:center; background:linear-gradient(135deg, rgba(255,255,255,0.45) 0%, rgba(255,255,255,0.15) 100%); backdrop-filter:blur(25px); border:1px solid rgba(255,255,255,0.3)">
        <div style="display:flex; flex-direction:column; gap:8px">
            <i class="fas fa-file-medical" style="font-size:32px; color:var(--accent-green)"></i>
            <div class="stat-value" style="font-size:28px"><?= count($pendaftaran) ?></div>
            <div class="stat-title" style="margin:0; font-size:12px">Total Kunjungan</div>
        </div>
    </div>
</div>

<div class="middle-row">
    <div class="activity-card glass">
        <div class="chart-header">
            <div>
                <h3><i class="fas fa-clipboard-list" style="margin-right:8px"></i> Riwayat Pendaftaran Terakhir</h3>
                <p>Status terkini pendaftaran Anda</p>
            </div>
                <a href="<?= base_url('pasien/daftar') ?>" class="btn glass-pill" style="padding:10px 24px; background:linear-gradient(135deg, var(--accent-green), rgba(47,133,90,0.8)); color:#fff; box-shadow:0 4px 12px rgba(47,133,90,0.25); border:1px solid rgba(255,255,255,0.3); text-decoration:none; font-weight:700"><i class="fas fa-plus" style="margin-right:8px"></i> Daftar Baru</a>
        </div>
        
        <div class="table-wrapper mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th style="color:var(--text-main)">TANGGAL DAFTAR</th>
                        <th style="color:var(--text-main)">DOKTER TUJUAN</th>
                        <th style="color:var(--text-main)">JADWAL</th>
                        <th style="color:var(--text-main)">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach (array_slice($pendaftaran, 0, 5) as $p): ?>
                    <tr>
                        <td><?= date('d M Y', strtotime($p->created_at)) ?></td>
                        <td>
                            <strong style="color:var(--text-main)"><?= htmlspecialchars($p->nama_dokter) ?></strong><br>
                            <small class="text-muted"><?= htmlspecialchars($p->spesialis) ?></small>
                        </td>
                        <td>
                            <div style="font-weight:700"><?= date('d M Y', strtotime($p->tanggal_kunjungan)) ?></div>
                            <small class="text-muted"><?= date('H:i', strtotime($p->jam_kunjungan)) ?> WIB</small>
                        </td>
                        <td>
                            <?php if($p->status == 'disetujui'): ?>
                                <span class="badge" style="background:var(--accent-green); color:#fff">Disetujui</span>
                                <span class="badge" style="background:linear-gradient(135deg, rgba(47,133,90,0.3), rgba(47,133,90,0.1)); color:var(--accent-green); border:1px solid var(--accent-green); font-weight:700; font-size:12px; padding:6px 12px; border-radius:var(--radius-pill); display:inline-flex; align-items:center; gap:6px"><i class="fas fa-check-circle"></i> Disetujui</span>
                            <?php elseif($p->status == 'ditolak'): ?>
                                <span class="badge" style="background:var(--accent-red); color:#fff">Ditolak</span>
                                <span class="badge" style="background:linear-gradient(135deg, rgba(197,48,48,0.3), rgba(197,48,48,0.1)); color:var(--accent-red); border:1px solid var(--accent-red); font-weight:700; font-size:12px; padding:6px 12px; border-radius:var(--radius-pill); display:inline-flex; align-items:center; gap:6px"><i class="fas fa-times-circle"></i> Ditolak</span>
                            <?php else: ?>
                                <span class="badge" style="background:var(--warning); color:#fff">Menunggu</span>
                                <span class="badge" style="background:linear-gradient(135deg, rgba(43,108,176,0.3), rgba(43,108,176,0.1)); color:var(--accent-blue); border:1px solid var(--accent-blue); font-weight:700; font-size:12px; padding:6px 12px; border-radius:var(--radius-pill); display:inline-flex; align-items:center; gap:6px"><i class="fas fa-hourglass-end"></i> Menunggu</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($pendaftaran)): ?>
                    <tr><td colspan="4" class="text-center text-muted" style="padding:40px">Anda belum pernah mendaftar berobat.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="activity-card glass" style="display:flex; flex-direction:column; justify-content:center; text-align:center; background:linear-gradient(135deg, rgba(255,255,255,0.7) 0%, rgba(255,255,255,0.3) 100%)">
        <div style="width:80px; height:80px; border-radius:50%; background:linear-gradient(135deg, rgba(43,108,176,0.3), rgba(43,108,176,0.1)); margin:0 auto 24px; display:flex; align-items:center; justify-content:center; font-size:32px; color:var(--accent-blue); box-shadow:0 8px 24px rgba(43,108,176,0.15); border:1px solid rgba(43,108,176,0.3)">
            <i class="fas fa-search"></i>
        </div>
        <h3 style="margin-bottom:8px; justify-content:center; color:var(--text-main); font-weight:800">Cek Status Detail</h3>
        <p style="font-size:13px; color:var(--text-muted); margin-bottom:24px">Pantau apakah pendaftaran Anda sudah disetujui, ditolak, atau masih diproses.</p>
        <a href="<?= base_url('pasien/status') ?>" class="btn glass-pill" style="align-self:center; padding:12px 28px; background:linear-gradient(135deg, var(--accent-blue), rgba(43,108,176,0.8)); color:#fff; box-shadow:0 4px 12px rgba(43,108,176,0.25); border:1px solid rgba(255,255,255,0.3); text-decoration:none; font-weight:700"><i class="fas fa-arrow-right"></i> Lihat Status Lengkap</a>
    </div>
</div>

