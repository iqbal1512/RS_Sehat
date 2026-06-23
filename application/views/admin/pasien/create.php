<div class="page-header">
    <div>
        <h1>Tambah Pasien Baru</h1>
        <p>Tambahkan data pasien baru untuk proses manajemen kunjungan.</p>
    </div>
    <div class="section-actions">
        <a href="<?= base_url('admin/pasien') ?>" class="btn btn-outline btn-sm">Kembali</a>
    </div>
</div>

<div class="card glass fade-in" style="max-width:700px">
    <div class="card-header"><h5><i class="fas fa-user-plus" style="margin-right:8px;color:var(--text-main)"></i>Tambah Data Pasien</h5></div>
    <div class="card-body">
        <?php if (validation_errors()): ?>
            <div class="alert alert-danger glass"><i class="fas fa-exclamation-circle"></i> <?= validation_errors() ?></div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('admin/pasien/tambah') ?>">
            <div class="form-group">
                <label>Nama Lengkap *</label>
                <input type="text" name="nama" class="form-control" value="<?= set_value('nama') ?>" required>
            </div>
            <div class="row">
                <div class="col-6"><div class="form-group">
                    <label>Tanggal Lahir *</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="<?= set_value('tanggal_lahir') ?>" required>
                </div></div>
                <div class="col-6"><div class="form-group">
                    <label>No. Telepon *</label>
                    <input type="text" name="nomor_telepon" class="form-control" value="<?= set_value('nomor_telepon') ?>" required>
                </div></div>
            </div>
            <div class="form-group">
                <label>Alamat *</label>
                <textarea name="alamat" class="form-control" required><?= set_value('alamat') ?></textarea>
            </div>
            <div class="row">
                <div class="col-6"><div class="form-group">
                    <label>Username *</label>
                    <input type="text" name="username" class="form-control" value="<?= set_value('username') ?>" required>
                </div></div>
                <div class="col-6"><div class="form-group">
                    <label>Password *</label>
                    <input type="password" name="password" class="form-control" required>
                </div></div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary glass-pill"><i class="fas fa-save"></i> Simpan Data</button>
                <a href="<?= base_url('admin/pasien') ?>" class="btn btn-outline glass-pill">Batal</a>
            </div>
        </form>
    </div>
</div>
