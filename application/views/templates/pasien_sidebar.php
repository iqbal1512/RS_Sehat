    <aside class="sidebar glass">
        <div class="brand">
            <i class="fas fa-hospital" style="color:var(--dark-card)"></i> RS Sehat
        </div>
        <div class="brand-sub">Portal Pasien</div>

        <nav class="nav-menu">
            <a href="<?= base_url('pasien') ?>" class="nav-item <?= ($this->uri->segment(2) == '' || $this->uri->segment(2) == 'index') ? 'active' : '' ?>">
                <i class="fas fa-home"></i> Beranda
            </a>
            <a href="<?= base_url('pasien/daftar') ?>" class="nav-item <?= ($this->uri->segment(2) == 'daftar') ? 'active' : '' ?>">
                <i class="fas fa-file-medical"></i> Daftar Berobat
            </a>
            <a href="<?= base_url('pasien/status') ?>" class="nav-item <?= ($this->uri->segment(2) == 'status' || $this->uri->segment(2) == 'detail') ? 'active' : '' ?>">
                <i class="fas fa-clipboard-check"></i> Cek Status
            </a>
        </nav>

        <div class="user-profile">
            <div class="avatar">
                <?= strtoupper(substr($this->session->userdata('pasien_nama'), 0, 1)) ?>
            </div>
            <div class="user-info">
                <h6><?= htmlspecialchars($this->session->userdata('pasien_nama')) ?></h6>
                <p>Pasien</p>
            </div>
        </div>
        
        <a href="<?= base_url('auth/logout') ?>" class="btn-upgrade" onclick="return confirm('Logout dari sistem?')" style="background:linear-gradient(135deg, #d9534f, rgba(197,48,48,0.8)); box-shadow:0 6px 20px rgba(197,48,48,0.25)">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </aside>

    <main class="main-area">
        <header class="top-nav glass-pill mb-4">
            <div style="display:flex; align-items:center; gap:16px; flex:1">
                <i class="fas fa-info-circle" style="color:var(--text-muted); font-size:18px"></i>
                <div>
                    <h5 style="margin:0; font-size:16px; font-weight:800"><?= isset($title) ? $title : 'Portal Pasien' ?></h5>
                    <p style="margin:0; font-size:12px; color:var(--text-muted); font-weight:600">Kelola pendaftaran dan cek status berobat Anda</p>
                </div>
            </div>

            <div class="nav-actions">
                <button class="icon-btn" style="cursor:pointer; border:none"><i class="fas fa-bell"></i></button>
            </div>
        </header>

        <!-- Flash Messages Global -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>
