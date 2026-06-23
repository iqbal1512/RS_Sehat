<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Pasien Baru - RS Sehat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        body.auth-body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            width: 100%;
            margin: 0;
            padding: 24px;
            gap: 0;
            overflow-x: hidden;
        }

        body.auth-body .auth-wrapper {
            width: 100%;
            max-width: 100%;
            min-height: unset;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
            margin: 0;
        }

        /* Card jadi lebih lebar karena isinya disusun 2 kolom */
        body.auth-body .auth-card.wide {
            max-width: 880px;
            width: 100%;
            margin: auto;
            padding: 40px 48px;
        }

        body.auth-body .auth-logo {
            text-align: center;
            margin-bottom: 24px;
        }

        body.auth-body .auth-logo h2 {
            font-size: 22px;
            margin-top: 4px;
        }

        body.auth-body .auth-logo p {
            font-size: 13px;
            line-height: 1.6;
            margin-top: 6px;
        }

        /* ===== Layout utama form: 2 kolom besar berdampingan ===== */
        .form-grid-2col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0 36px;
            align-items: start;
        }

        /* Garis pemisah vertikal antar kolom kiri & kanan */
        .form-col-left {
            padding-right: 36px;
            border-right: 1px dashed rgba(255, 255, 255, 0.6);
        }

        .form-col-right {
            padding-left: 0;
        }

        .form-col-title {
            font-size: 13px;
            font-weight: 800;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-col-title i {
            color: var(--accent-blue);
        }

        /* Dalam tiap kolom, Tanggal Lahir & Nomor Telepon tetap 2 sub-kolom */
        body.auth-body .form-group {
            margin-bottom: 16px;
        }

        body.auth-body .row {
            margin: 0 -7px;
        }

        body.auth-body .col-6 {
            padding: 0 7px;
        }

        /* Tombol & footer full width di bawah grid 2 kolom */
        .form-footer-full {
            grid-column: 1 / -1;
            margin-top: 8px;
        }

        /* ===== Responsif: di layar sempit, balik jadi 1 kolom stack ===== */
        @media (max-width: 760px) {
            body.auth-body .auth-card.wide {
                max-width: 100%;
                padding: 28px 24px;
            }

            .form-grid-2col {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .form-col-left {
                padding-right: 0;
                border-right: none;
                border-bottom: 1px dashed rgba(255, 255, 255, 0.6);
                padding-bottom: 16px;
                margin-bottom: 16px;
            }

            body.auth-body .row {
                flex-direction: column;
            }

            body.auth-body .col-6 {
                width: 100%;
            }
        }
    </style>
</head>
<body class="auth-body">
    <div class="auth-wrapper">
        <div class="auth-card wide">
            <div class="auth-logo">
                <div class="stat-icon-wrapper" style="margin: 0 auto 16px; width:64px; height:64px; background:var(--dark-card); color:#fff; font-size:28px; box-shadow:0 8px 24px rgba(0,0,0,0.2)">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h2>Daftar Pasien Baru</h2>
                <p style="color:var(--text-muted); font-weight:600">Lengkapi data diri Anda untuk membuat akun pendaftaran berobat online.</p>
            </div>

            <?php if (validation_errors()): ?>
                <div class="alert alert-danger glass"><i class="fas fa-exclamation-circle"></i> <?= validation_errors() ?></div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('auth/register_process') ?>">
                <div class="form-grid-2col">

                    <!-- KOLOM KIRI: Data Diri -->
                    <div class="form-col-left">
                        <div class="form-col-title"><i class="fas fa-id-card"></i> Data Diri</div>

                        <div class="form-group">
                            <label>Nama Lengkap (Sesuai KTP) *</label>
                            <input type="text" name="nama" class="form-control" value="<?= set_value('nama') ?>" required>
                        </div>

                        <div class="row">
                            <div class="col-6"><div class="form-group">
                                <label>Tanggal Lahir *</label>
                                <input type="date" name="tanggal_lahir" class="form-control" value="<?= set_value('tanggal_lahir') ?>" required>
                            </div></div>
                            <div class="col-6"><div class="form-group">
                                <label>Nomor Telepon/HP *</label>
                                <input type="text" name="nomor_telepon" class="form-control" value="<?= set_value('nomor_telepon') ?>" required>
                            </div></div>
                        </div>

                        <div class="form-group">
                            <label>Alamat Lengkap *</label>
                            <textarea name="alamat" class="form-control" rows="4" required><?= set_value('alamat') ?></textarea>
                        </div>
                    </div>

                    <!-- KOLOM KANAN: Akun Login -->
                    <div class="form-col-right">
                        <div class="form-col-title"><i class="fas fa-lock"></i> Akun Login</div>

                        <div class="form-group">
                            <label>Buat Username *</label>
                            <input type="text" name="username" class="form-control" value="<?= set_value('username') ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Buat Password *</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Konfirmasi Password *</label>
                            <input type="password" name="konfirmasi_password" class="form-control" required>
                        </div>
                    </div>

                    <!-- FULL WIDTH: Tombol Submit -->
                    <div class="form-footer-full">
                        <button type="submit" class="btn btn-primary mt-3" style="width: 100%;"><i class="fas fa-user-check"></i> Daftar Sekarang</button>
                    </div>

                </div>
            </form>

            <div class="text-center" style="margin-top:24px; font-size:14px">
                <span class="text-muted" style="font-weight:600">Sudah punya akun?</span>
                <a href="<?= base_url('auth/login') ?>" style="color:var(--dark-card); font-weight:800; text-decoration:none">Masuk di sini</a>
            </div>
        </div>
    </div>
</body>
</html>