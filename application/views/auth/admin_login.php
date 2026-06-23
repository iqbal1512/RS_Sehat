<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - RS Sehat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css?v=1.1') ?>">
</head>
<body class="auth-body">
    <div class="auth-wrapper">
        
        <div class="auth-card">
            <div class="auth-logo">
                <div class="stat-icon-wrapper" style="margin: 0 auto 16px; width:64px; height:64px; background:var(--dark-card); color:#fff; font-size:28px; box-shadow:0 8px 24px rgba(0,0,0,0.2)">
                    <i class="fas fa-user-shield"></i>
                </div>
                <h2>Portal Admin</h2>
                <p style="color:var(--text-muted); font-weight:600">Akses manajemen rumah sakit.</p>
            </div>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger glass"><i class="fas fa-exclamation-circle"></i> <?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>

            <div class="role-tabs glass-pill" style="margin-bottom:24px; border-radius:var(--radius-pill)">
                <a href="<?= base_url('auth/login') ?>" class="tab" style="text-decoration:none; color:var(--text-muted); border-radius:var(--radius-pill)">Pasien</a>
                <a href="<?= base_url('auth/admin_login') ?>" class="tab active" style="text-decoration:none; border-radius:var(--radius-pill)">Admin</a>
            </div>

            <form method="post" action="<?= base_url('auth/admin_login_process') ?>">
                <div class="form-group">
                    <label>Username Admin</label>
                    <input type="text" name="username" class="form-control glass-pill" placeholder="Masukkan username" required autofocus>
                </div>
                <div class="form-group mb-4">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control glass-pill" placeholder="Masukkan password" required>
                </div>
                <button type="submit" class="btn btn-primary glass-pill" style="width: 100%; padding:14px; font-size:16px; background:var(--dark-card); color:#fff; cursor: pointer; border: none;"><i class="fas fa-shield-alt"></i> Login Administrator</button>
            </form>
        </div>

    </div>
</body>
</html>