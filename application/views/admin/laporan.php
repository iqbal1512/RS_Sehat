<!-- Stats Summary -->
<div class="page-header">
    <div>
        <h1>Laporan & Statistik</h1>
        <p>Filter dan unduh laporan pendaftaran pasien sesuai periode yang diperlukan.</p>
    </div>
    <div class="button-group">
        <a href="<?= base_url('admin/laporan/csv?start_date='.$start_date.'&end_date='.$end_date) ?>" class="btn btn-success btn-sm"><i class="fas fa-file-csv"></i> CSV</a>
        <a href="<?= base_url('admin/laporan/pdf?start_date='.$start_date.'&end_date='.$end_date) ?>" class="btn btn-danger btn-sm" target="_blank"><i class="fas fa-file-pdf"></i> PDF</a>
    </div>
</div>
<div class="dash-grid mb-4">
    <div class="stat-card glass">
        <div class="stat-title">Total Pendaftaran</div>
        <div class="stat-value"><?= $total_mendaftar ?></div>
    </div>
    <div class="stat-card glass">
        <div class="stat-title">Pasien Diterima</div>
        <div class="stat-value" style="color:var(--accent-green)"><?= $total_disetujui ?></div>
    </div>
    <div class="stat-card glass">
        <div class="stat-title">Pasien Ditolak</div>
        <div class="stat-value" style="color:var(--accent-red)"><?= $total_ditolak ?></div>
    </div>
    <div class="stat-card dark-card">
        <div class="dark-title">Total Akun Pasien</div>
        <div class="dark-value"><?= $total_pasien ?></div>
    </div>
</div>

<div class="card glass fade-in mb-4">
    <div class="card-body">
        <form method="get" action="<?= base_url('admin/laporan') ?>" class="row align-center">
            <div class="col-4">
                <label style="font-size:12px; font-weight:700; color:var(--text-muted); display:block; margin-bottom:6px; letter-spacing:1px">Dari Tanggal</label>
                <input type="date" name="start_date" class="form-control glass-pill" value="<?= htmlspecialchars($start_date) ?>">
            </div>
            <div class="col-4">
                <label style="font-size:12px; font-weight:700; color:var(--text-muted); display:block; margin-bottom:6px; letter-spacing:1px">Sampai Tanggal</label>
                <input type="date" name="end_date" class="form-control glass-pill" value="<?= htmlspecialchars($end_date) ?>">
            </div>
            <div class="col-4" style="padding-top:20px; display:flex; gap:12px">
                <button type="submit" class="btn btn-primary glass-pill"><i class="fas fa-filter"></i> Filter</button>
                <a href="<?= base_url('admin/laporan') ?>" class="btn btn-outline glass-pill">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card glass fade-in card--table">
    <div class="card-header card-header--table d-flex justify-between align-center">
        <h5><i class="fas fa-file-alt" style="margin-right:8px"></i> Data Laporan Pendaftaran</h5>
            <div class="button-group">
                <a href="<?= base_url('admin/laporan/csv?start_date='.$start_date.'&end_date='.$end_date) ?>" class="btn btn-success btn-sm">
                    <i class="fas fa-file-csv"></i> Unduh CSV
                </a>
                <a href="<?= base_url('admin/laporan/pdf?start_date='.$start_date.'&end_date='.$end_date) ?>" class="btn btn-danger btn-sm" target="_blank">
                    <i class="fas fa-file-pdf"></i> Unduh PDF
                </a>
            </div>
    </div>
    <div class="card-body">
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tgl Daftar</th>
                        <th>Pasien</th>
                        <th>Dokter Tujuan</th>
                        <th>Jadwal Kunjungan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($report_data)): ?>
                    <tr><td colspan="5" class="text-center text-muted empty-state">Tidak ada data laporan untuk periode ini</td></tr>
                    <?php else: foreach ($report_data as $r): ?>
                    <tr>
                        <td><?= date('d M Y', strtotime($r->created_at)) ?></td>
                        <td>
                            <strong style="color:var(--text-main)"><?= htmlspecialchars($r->nama_pasien) ?></strong><br>
                            <small class="text-muted"><?= htmlspecialchars($r->nomor_telepon) ?></small>
                        </td>
                        <td>
                            <strong style="color:var(--text-main)"><?= htmlspecialchars($r->nama_dokter) ?></strong><br>
                            <small class="text-muted"><?= htmlspecialchars($r->spesialis) ?></small>
                        </td>
                        <td>
                            <i class="far fa-calendar" style="color:var(--text-main)"></i> <?= date('d M Y', strtotime($r->tanggal_kunjungan)) ?> 
                            <i class="far fa-clock" style="color:var(--accent-blue)"></i> <?= date('H:i', strtotime($r->jam_kunjungan)) ?>
                        </td>
                        <td>
                            <span class="badge badge-<?= $r->status ?>"><?= ucfirst($r->status) ?></span>
                        </td>
                    </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
