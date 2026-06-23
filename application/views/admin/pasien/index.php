<div class="page-header">
    <div>
        <h1>Kelola Pasien</h1>
        <p>Data pasien lengkap dengan akses edit, tambah, dan hapus dari satu tampilan.</p>
    </div>
    <div class="section-actions">
        <a href="<?= base_url('admin/pasien/tambah') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Pasien</a>
    </div>
</div>

<div class="card glass fade-in card--table">
    <div class="card-header card-header--table">
        <h5><i class="fas fa-users" style="margin-right:8px"></i> Data Pasien</h5>
    </div>
    <div class="card-body">
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th><th>Nama</th><th>Tgl Lahir</th><th>Alamat</th><th>No. Telepon</th><th>Username</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($pasien_list as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><strong><?= htmlspecialchars($p->nama) ?></strong></td>
                        <td><?= date('d M Y', strtotime($p->tanggal_lahir)) ?></td>
                        <td class="td-truncate"><?= htmlspecialchars($p->alamat) ?></td>
                        <td><?= htmlspecialchars($p->nomor_telepon) ?></td>
                        <td><span class="badge badge-username"><?= htmlspecialchars($p->username) ?></span></td>
                        <td class="actions-cell">
                            <div class="d-flex gap-2">
                                <a href="<?= base_url('admin/pasien/edit/'.$p->id) ?>" class="btn btn-warning btn-sm glass-pill" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="<?= base_url('admin/pasien/hapus/'.$p->id) ?>" class="btn btn-danger btn-sm glass-pill" title="Hapus" onclick="return confirm('Yakin hapus pasien ini?')"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($pasien_list)): ?>
                    <tr><td colspan="7" class="text-center text-muted empty-state">Belum ada data pasien</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
