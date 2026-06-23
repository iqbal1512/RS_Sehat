<div class="page-header">
    <div>
        <h1>Jadwal Pendaftaran</h1>
        <p>Kelola jadwal kunjungan pasien dengan filter tanggal yang mudah digunakan.</p>
    </div>
    <div class="section-actions">
        <a href="<?= base_url('admin/pendaftaran') ?>" class="btn btn-outline btn-sm">Lihat Pendaftaran</a>
    </div>
</div>
<div class="card glass fade-in mb-4">
    <div class="card-body">
        <form method="get" action="<?= base_url('admin/jadwal') ?>" class="d-flex align-center gap-5">
            <div style="flex:1">
                <label style="font-size:12px; font-weight:bold; color:var(--text-muted); display:block; margin-bottom:6px; letter-spacing:1px">Filter Tanggal Kunjungan</label> 
                <input type="date" name="tanggal" class="form-control glass-pill" style="max-width:300px" value="<?= htmlspecialchars($filter_tanggal) ?>">
            </div>
            <div style="padding-top:8px">
                <button type="submit" class="btn btn-primary glass-pill"><i class="fas fa-filter"></i> Tampilkan Jadwal</button>
                <a href="<?= base_url('admin/jadwal') ?>" class="btn btn-outline glass-pill">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card glass fade-in-delay-1 card--table">
    <div class="card-header card-header--table">
        <h5>
            <i class="fas fa-calendar-alt" style="margin-right:8px"></i>
            Jadwal Kunjungan Pasien 
            <?= $filter_tanggal ? '<span class="badge" style="background:var(--dark-card);color:#fff">'.date('d F Y', strtotime($filter_tanggal)).'</span>' : '(Semua Tanggal)' ?>
        </h5>
    </div>
    <div class="card-body">
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal & Jam</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Keluhan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($jadwal_list as $j): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <strong style="color:var(--text-main)"><?= date('d M Y', strtotime($j->tanggal_kunjungan)) ?></strong><br>
                            <span class="text-warning" style="font-weight:800"><i class="far fa-clock"></i> <?= date('H:i', strtotime($j->jam_kunjungan)) ?></span>
                        </td>
                        <td>
                            <strong style="color:var(--text-main)"><?= htmlspecialchars($j->nama_pasien) ?></strong><br>
                            <small class="text-muted"><?= htmlspecialchars($j->nomor_telepon) ?></small>
                        </td>
                        <td>
                            <strong style="color:var(--text-main)"><?= htmlspecialchars($j->nama_dokter) ?></strong><br>
                            <small class="text-muted"><?= htmlspecialchars($j->spesialis) ?></small>
                        </td>
                        <td class="td-truncate">
                            <span style="font-size:13px; color:var(--text-muted)" title="<?= htmlspecialchars($j->keluhan) ?>">
                                <?= strlen($j->keluhan) > 50 ? substr(htmlspecialchars($j->keluhan), 0, 50).'...' : htmlspecialchars($j->keluhan) ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($j->status === 'disetujui'): ?>
                                <span class="badge badge-disetujui"><i class="fas fa-check"></i> Disetujui</span>
                            <?php elseif ($j->status === 'ditolak'): ?>
                                <span class="badge badge-ditolak"><i class="fas fa-times"></i> Ditolak</span>
                            <?php else: ?>
                                <span class="badge badge-menunggu"><i class="fas fa-hourglass-end"></i> Menunggu</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($jadwal_list)): ?>
                    <tr><td colspan="6" class="text-center text-muted empty-state">Tidak ada jadwal kunjungan <?= $filter_tanggal ? 'pada tanggal ini' : '' ?></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
