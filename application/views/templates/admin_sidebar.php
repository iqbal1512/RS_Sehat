    <aside class="sidebar glass">
        <div class="brand">
            <i class="fas fa-hospital" style="color:var(--dark-card)"></i> RS Sehat
        </div>
        <div class="brand-sub">Premium Tier</div>

        <nav class="nav-menu">
            <a href="<?= base_url('admin') ?>" class="nav-item <?= ($this->uri->segment(1) == 'admin' && !$this->uri->segment(2)) ? 'active' : '' ?>">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
            <a href="<?= base_url('admin/pasien') ?>" class="nav-item <?= ($this->uri->segment(2) == 'pasien') ? 'active' : '' ?>">
                <i class="fas fa-users"></i> Data Pasien
            </a>
            <a href="<?= base_url('admin/pendaftaran') ?>" class="nav-item <?= ($this->uri->segment(2) == 'pendaftaran') ? 'active' : '' ?>">
                <i class="fas fa-clipboard-list"></i> Pendaftaran
            </a>
            <a href="<?= base_url('admin/jadwal') ?>" class="nav-item <?= ($this->uri->segment(2) == 'jadwal') ? 'active' : '' ?>">
                <i class="fas fa-calendar-alt"></i> Jadwal
            </a>
            <a href="<?= base_url('admin/laporan') ?>" class="nav-item <?= ($this->uri->segment(2) == 'laporan') ? 'active' : '' ?>">
                <i class="fas fa-chart-line"></i> Laporan
            </a>
        </nav>

        <div class="user-profile">
            <div class="avatar">
                <?= strtoupper(substr($this->session->userdata('admin_nama'), 0, 1)) ?>
            </div>
            <div class="user-info">
                <h6><?= $this->session->userdata('admin_nama') ?></h6>
                <p>Administrator</p>
            </div>
        </div>
        
        <div class="user-menu">
            <button class="user-menu-btn" type="button">
                <i class="fas fa-user-cog"></i>
                <span>Account</span>
                <i class="fas fa-chevron-down user-menu-caret"></i>
            </button>

            <div class="user-menu-dropdown" role="menu" aria-label="User menu">
                <a href="<?= base_url('auth/logout') ?>" class="user-menu-item" onclick="return confirm('Logout dari sistem?')" role="menuitem">
                    <i class="fas fa-right-from-bracket"></i>
                    <span>Logout System</span>
                </a>
            </div>
        </div>
    </aside>


    <main class="main-area">
        <header class="top-nav glass-pill mb-4">
            <div class="search-box">
                <i class="fas fa-search" style="color:var(--text-muted)"></i>
                <input type="text" placeholder="Search data...">
            </div>
            
            <div class="top-menu">
                <a href="#" class="active"><?= isset($title) ? $title : 'Executive Overview' ?></a>
                <a href="<?= base_url('admin/laporan') ?>">Reports</a>
                <a href="<?= base_url('admin/pendaftaran') ?>">History</a>
                <a href="<?= base_url('admin/jadwal') ?>">Activity</a>
            </div>

            <div class="nav-actions">
                <button class="icon-btn"><i class="fas fa-bell"></i></button>
                <button class="icon-btn"><i class="fas fa-moon"></i></button>
            </div>
        </header>
        </header>

        <!-- Sentinel untuk mendeteksi scroll -->
        <div id="scroll-sentinel"></div>

        <!-- Flash Messages Global -->
        <?php if ($this->session->flashdata('success')): ?>
                <i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>
