<div class="page-header">
    <div>
        <h1>Formulir Pendaftaran</h1>
        <p>Isi data kunjungan dengan lengkap untuk proses pendaftaran yang cepat.</p>
    </div>
    <div class="section-actions">
        <a href="<?= base_url('pasien') ?>" class="btn btn-outline btn-sm">Kembali</a>
    </div>
</div>

<div class="row" style="gap:24px">
    <div class="col-8" style="flex:1; min-width:0">
        <div class="card glass fade-in" style="padding:0">
            <div class="card-header" style="border-bottom:1px solid rgba(255,255,255,0.3); padding:24px">
                <h5 style="margin:0; display:flex; align-items:center; gap:12px; color:var(--text-main); font-weight:800; font-size:18px">
                    <div class="stat-icon-wrapper" style="background:rgba(47,133,90,0.2); color:var(--accent-green)"><i class="fas fa-file-medical"></i></div>
                    Formulir Pendaftaran Berobat
                </h5>
            </div>
            <div class="card-body" style="padding:32px">
                <form method="post" action="<?= base_url('pasien/daftar') ?>" style="display:flex; flex-direction:column; gap:20px">
                    <div class="form-group" style="margin:0">
                        <label style="display:block; margin-bottom:8px; font-weight:700; font-size:14px; color:var(--text-main)">Pilih Dokter Spesialis <span style="color:var(--accent-red)">*</span></label>
                        <select name="dokter_id" class="form-control glass-pill" required style="padding:12px 16px; font-size:14px">
                            <option value="">-- Pilih Dokter --</option>
                            <?php foreach($dokter_list as $d): ?>
                                <option value="<?= $d->id ?>"><?= htmlspecialchars($d->nama) ?> • <?= htmlspecialchars($d->spesialis) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group" style="margin:0">
                        <label style="display:block; margin-bottom:8px; font-weight:700; font-size:14px; color:var(--text-main)">Tanggal Kunjungan <span style="color:var(--accent-red)">*</span></label>
                        <input type="date" name="tanggal_kunjungan" class="form-control glass-pill" min="<?= date('Y-m-d', strtotime('+1 day')) ?>" required style="padding:12px 16px; font-size:14px">
                    </div>
                    
                    <div class="form-group" style="margin:0">
                        <label style="display:block; margin-bottom:8px; font-weight:700; font-size:14px; color:var(--text-main)">Waktu Kunjungan <span style="color:var(--accent-red)">*</span></label>
                        <select name="jam_kunjungan" class="form-control glass-pill" required style="padding:12px 16px; font-size:14px">
                            <option value="">-- Pilih Waktu --</option>
                            <option value="08:00:00">08:00 - Pagi</option>
                            <option value="10:00:00">10:00 - Pagi</option>
                            <option value="13:00:00">13:00 - Siang</option>
                            <option value="15:00:00">15:00 - Sore</option>
                            <option value="19:00:00">19:00 - Malam</option>
                        </select>
                    </div>

                    <div class="form-group" style="margin:0">
                        <label style="display:block; margin-bottom:8px; font-weight:700; font-size:14px; color:var(--text-main)">Keluhan / Gejala <span style="color:var(--accent-red)">*</span></label>
                        <textarea name="keluhan" class="form-control" rows="4" placeholder="Ceritakan keluhan yang Anda rasakan secara detail..." required style="border-radius:var(--radius-sm); padding:12px 16px; font-size:14px; background:rgba(255,255,255,0.3); border:1px solid rgba(255,255,255,0.4)"></textarea>
                    </div>
                    
                    <button type="submit" class="btn glass-pill" style="padding:14px 28px; font-weight:700; margin-top:8px; align-self:flex-start; background:linear-gradient(135deg, var(--accent-green), rgba(47,133,90,0.8)); color:#fff; box-shadow:0 6px 20px rgba(47,133,90,0.3); border:1px solid rgba(255,255,255,0.3)"><i class="fas fa-paper-plane"></i> Kirim Pendaftaran</button>
                </form>
            </div>
        </div>
    </div>
    
    <div style="width:280px; flex-shrink:0">
        <div class="card glass fade-in" style="padding:24px; display:flex; flex-direction:column; gap:16px">
            <div style="display:flex; align-items:center; gap:12px; margin-bottom:8px">
                <div class="stat-icon-wrapper" style="background:rgba(43,108,176,0.2); color:var(--accent-blue)"><i class="fas fa-lightbulb"></i></div>
                <h6 style="margin:0; font-weight:800; color:var(--text-main); font-size:14px">Panduan</h6>
            </div>
            <div style="font-size:13px; line-height:1.8; color:var(--text-muted)">
                <p style="margin:0 0 12px 0"><strong style="color:var(--text-main)">✓ Tanggal</strong><br>Pilih minimal 1 hari ke depan</p>
                <p style="margin:0 0 12px 0"><strong style="color:var(--text-main)">✓ Keluhan</strong><br>Jelaskan detil agar dokter siap</p>
                <p style="margin:0"><strong style="color:var(--text-main)">✓ Status</strong><br>Cek menu "Cek Status" untuk update</p>
            </div>
        </div>
    </div>
</div>
