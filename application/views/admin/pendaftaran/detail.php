<div class="page-header">
    <div>
        <h1>Detail Pendaftaran</h1>
        <p>Review dan kelola status pendaftaran pasien secara cepat.</p>
    </div>
    <div class="section-actions">
        <a href="<?= base_url('admin/pendaftaran') ?>" class="btn btn-outline btn-sm">Kembali ke Daftar</a>
    </div>
</div>

<div class="row">
    <div class="col-8">
        <div class="card glass fade-in">
            <div class="card-header d-flex justify-between align-center">
                <h5><i class="fas fa-file-medical-alt card-header-icon"></i> Detail Pendaftaran #<?= $detail->id ?></h5>
                <span class="status-badge <?= $detail->status ?>"><?= ucfirst($detail->status) ?></span>
            </div>
            <div class="card-body">
                <div class="detail-grid">
                    <div class="detail-item">
                        <label>Data Pasien</label>
                        <p><strong><?= htmlspecialchars($detail->nama_pasien) ?></strong></p>
                        <small class="meta-line"><i class="fas fa-phone-alt"></i> <?= htmlspecialchars($detail->nomor_telepon) ?></small>
                        <small class="meta-line"><i class="fas fa-calendar-day"></i> <?= date('d M Y', strtotime($detail->tanggal_lahir)) ?></small>
                        <small class="meta-line"><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($detail->alamat_pasien) ?></small>
                    </div>
                    <div class="detail-item">
                        <label>Data Dokter Tujuan</label>
                        <p><strong><?= htmlspecialchars($detail->nama_dokter) ?></strong></p>
                        <small class="status-doctor-tag"><?= htmlspecialchars($detail->spesialis) ?></small>
                        <small class="meta-line"><i class="far fa-calendar-check"></i> Jadwal Praktek: <?= htmlspecialchars($detail->jadwal_hari) ?></small>
                        <small class="meta-line"><i class="far fa-clock"></i> Jam Praktek: <?= htmlspecialchars($detail->jadwal_jam) ?></small>
                    </div>
                    <div class="detail-item detail-full">
                        <label>Keluhan Pasien</label>
                        <p class="complaint-box">
                            <?= nl2br(htmlspecialchars($detail->keluhan)) ?>
                        </p>
                    </div>
                    <div class="detail-item">
                        <label>Jadwal Kunjungan Yang Diminta</label>
                        <p class="detail-date"><i class="far fa-calendar-alt"></i> <?= date('d F Y', strtotime($detail->tanggal_kunjungan)) ?></p>
                        <p class="detail-time"><i class="far fa-clock"></i> <?= date('H:i', strtotime($detail->jam_kunjungan)) ?> WIB</p>
                    </div>
                    <div class="detail-item" style="margin-top:16px;">
                        <label>Tanggal Dibuat</label>
                        <p class="text-muted"><?= date('d F Y H:i', strtotime($detail->created_at)) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-4">
        <div class="card glass fade-in-delay-1">
            <div class="card-header">
                <h5><i class="fas fa-tasks" style="margin-right:8px"></i> Tindakan Admin</h5>
            </div>
                <div class="card-body">
                <?php if ($detail->status === 'menunggu'): ?>
                    <form method="post" action="<?= base_url('admin/pendaftaran/setujui/'.$detail->id) ?>" class="mb-3">
                        <div class="form-group">
                            <label>Catatan untuk pasien (opsional)</label>
                            <textarea name="catatan_admin" class="form-control" rows="3" placeholder="Misal: Harap datang 30 menit lebih awal"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success glass-pill btn-block" onclick="return confirm('Setujui pendaftaran ini?')">
                            <i class="fas fa-check"></i> Setujui Pendaftaran
                        </button>
                    </form>
                    
                    <form method="post" action="<?= base_url('admin/pendaftaran/tolak/'.$detail->id) ?>">
                        <div class="form-group">
                            <label>Alasan penolakan (opsional)</label>
                            <textarea name="catatan_admin" class="form-control" rows="3" placeholder="Misal: Jadwal dokter penuh"></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger glass-pill btn-block" onclick="return confirm('Tolak pendaftaran ini?')">
                            <i class="fas fa-times"></i> Tolak Pendaftaran
                        </button>
                    </form>
                <?php else: ?>
                    <div class="alert <?= $detail->status == 'disetujui' ? 'alert-success' : 'alert-danger' ?> glass">
                        <div class="alert-title"><i class="fas <?= $detail->status == 'disetujui' ? 'fa-check-circle' : 'fa-times-circle' ?>"></i> Pendaftaran <?= ucfirst($detail->status) ?></div>
                        <div class="alert-body">
                            <strong>Catatan Admin:</strong><br>
                            <?= empty($detail->catatan_admin) ? '-' : nl2br(htmlspecialchars($detail->catatan_admin)) ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
