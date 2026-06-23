<div class="page-header">
    <div>
        <h1>Data Pendaftaran</h1>
        <p>Kelola semua pendaftaran pasien dan lihat status terbaru dari satu halaman.</p>
    </div>
    <div class="section-actions">
        <a href="<?= base_url('admin/jadwal') ?>" class="btn btn-outline btn-sm">Jadwal</a>
        <a href="<?= base_url('admin/laporan') ?>" class="btn btn-outline btn-sm">Laporan</a>
    </div>
</div>
<div class="card glass fade-in" style="padding:0">
    <div class="card-header d-flex justify-between align-center" style="padding:24px 24px 0">
        <h5><i class="fas fa-clipboard-list" style="margin-right:8px"></i> Data Pendaftaran Pasien</h5>
    </div>
    <div class="card-body" style="padding:0">
        <div class="table-wrapper" style="padding: 0 24px 24px">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Daftar</th>
                        <th>Pasien</th>
                        <th>Dokter Tujuan</th>
                        <th>Jadwal Kunjungan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($pendaftaran_list as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <strong><?= date('d M Y', strtotime($p->created_at)) ?></strong>
                            <small class="meta-line"><i class="far fa-clock"></i> <?= date('H:i', strtotime($p->created_at)) ?></small>
                        </td>
                        <td>
                            <strong><?= htmlspecialchars($p->nama_pasien) ?></strong>
                            <small class="meta-line phone"><i class="fas fa-phone-alt"></i> <?= htmlspecialchars($p->nomor_telepon) ?></small>
                        </td>
                        <td>
                            <strong><?= htmlspecialchars($p->nama_dokter) ?></strong>
                            <small class="status-doctor-tag meta-line"><?= htmlspecialchars($p->spesialis) ?></small>
                        </td>
                        <td>
                            <div class="meta-line"><i class="far fa-calendar-alt"></i> <?= date('d M Y', strtotime($p->tanggal_kunjungan)) ?></div>
                            <div class="meta-line"><i class="far fa-clock"></i> <?= date('H:i', strtotime($p->jam_kunjungan)) ?></div>
                        </td>
                        <td>
                            <?php if ($p->status === 'disetujui'): ?>
                                <span class="status-badge disetujui"><i class="fas fa-check-circle"></i> Disetujui</span>
                            <?php elseif ($p->status === 'ditolak'): ?>
                                <span class="status-badge ditolak"><i class="fas fa-times-circle"></i> Ditolak</span>
                            <?php else: ?>
                                <span class="status-badge menunggu"><i class="fas fa-hourglass-end"></i> Menunggu</span>
                            <?php endif; ?>
                        </td>
                        <td class="actions-cell">
                            <a href="<?= base_url('admin/pendaftaran/detail/'.$p->id) ?>" class="detail-button" title="Lihat Detail">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($pendaftaran_list)): ?>
                    <tr><td colspan="7" class="text-center text-muted" style="padding:30px">Belum ada data pendaftaran</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
