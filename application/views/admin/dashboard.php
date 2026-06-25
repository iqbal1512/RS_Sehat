
<style>
.custom-dashboard-wrapper{
    width:100%;
    max-width:none !important;
    padding:20px;
    margin:0;
    box-sizing:border-box;
}

.custom-dashboard-wrapper .dash-grid {
    display: grid !important;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)) !important;
    gap: 32px !important;
    margin-bottom: 40px !important;
}

/* Chart + Activity */
.custom-dashboard-wrapper .middle-row {
    display: grid;
    grid-template-columns: minmax(0, 2fr) minmax(350px, 1fr);
    gap: 24px;
    width: 100%;
    margin-bottom: 40px;
}

/* Tracking */
.custom-dashboard-wrapper .tracking-row{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:20px;
    width:100%;
}

/* Anti Overflow */
.chart-card,
.activity-card,
.track-card,
.custom-dashboard-wrapper .stat-card,
.custom-dashboard-wrapper .dark-card {
    padding: 24px 20px !important;  
}

.chart-container{
    width:100%;
    height:280px !important;
}
@media (max-width:992px){

    .middle-row{
        grid-template-columns:1fr !important;
    }

    .dash-grid{
        grid-template-columns:repeat(2,1fr);
    }

    .tracking-row{
        grid-template-columns:repeat(2,1fr);
    }
}

@media (max-width:768px){

    .dash-grid,
    .tracking-row{
        grid-template-columns:1fr;
    }

    .middle-row{
        grid-template-columns:1fr;
    }

    .stat-value,
    .dark-value{
        font-size:28px !important;
    }

    .chart-container{
        height:220px !important;
    }
}
</style>

<div class="custom-dashboard-wrapper">

    <div class="page-header" style="margin-bottom: 24px;">
        <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; flex-wrap: wrap; gap: 16px;">
            <div class="section-actions">
                <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-info btn-sm">Dashboard</a>
                <a href="<?= base_url('admin/pendaftaran') ?>" class="btn btn-outline btn-sm">Pendaftaran</a>
                <a href="<?= base_url('admin/jadwal') ?>" class="btn btn-outline btn-sm">Jadwal</a>
                <a href="<?= base_url('admin/laporan') ?>" class="btn btn-outline btn-sm">Laporan</a>
            </div>
            <div>
                <span class="status-doctor-tag" style="background: rgba(255,255,255,0.3); padding: 10px 20px; border-radius: 50px; font-weight: 700; font-size: 13px;">
                    <i class="fas fa-user-shield"></i> Mode Admin
                </span>
            </div>
        </div>
        
        <div style="text-align: center; margin-top: 20px;">
            <h1 style="font-size: 34px; font-weight: 800; margin-bottom: 6px; letter-spacing: -0.5px;">Ringkasan Admin</h1>
            <p style="color: var(--text-muted); font-size: 15px; font-weight: 500;">Ringkasan pendaftaran pasien, statistik harian, dan aktivitas terbaru dalam satu tampilan.</p>
        </div>
    </div>

    <div class="dash-grid">
        <div class="stat-card glass">
            <div class="stat-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <div class="stat-icon-wrapper" style="font-size: 20px;"><i class="fas fa-users"></i></div>
                <div class="stat-badge positive" style="font-size: 12px; font-weight: 700;">+12.5%</div>
            </div>
            <div class="stat-title">Total Pasien</div>
            <div class="stat-value"><?= $total_pasien ?></div>
        </div>
        
        <div class="stat-card glass">
            <div class="stat-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <div class="stat-icon-wrapper" style="font-size: 20px;"><i class="fas fa-clock"></i></div>
                <div class="stat-badge negative" style="font-size: 12px; font-weight: 700;">-1.8%</div>
            </div>
            <div class="stat-title">Menunggu</div>
            <div class="stat-value"><?= $total_menunggu ?></div>
        </div>
        
        <div class="stat-card glass">
            <div class="stat-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <div class="stat-icon-wrapper" style="font-size: 20px;"><i class="fas fa-check-circle"></i></div>
                <div class="stat-badge positive" style="font-size: 12px; font-weight: 700;">+4.2%</div>
            </div>
            <div class="stat-title">Disetujui</div>
            <div class="stat-value"><?= $total_disetujui ?></div>
        </div>
        
        <div class="stat-card dark-card">
            <div class="dark-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <div class="stat-icon-wrapper" style="background:#fff; color:var(--dark-card); font-size: 20px;"><i class="fas fa-times-circle"></i></div>
                <div class="dark-brand" style="font-weight: 800; letter-spacing: 1px; font-size: 12px;">RS PLATINUM</div>
            </div>
            <div class="dark-title">Pendaftaran Ditolak</div>
            <div class="dark-value"><?= $total_ditolak ?></div>
            <div class="dark-footer" style="margin-top: 10px; opacity: 0.6; font-size: 11px;">Total Keseluruhan</div>
        </div>
    </div>

    <div class="middle-row">
        <div class="chart-card glass">
            <div class="chart-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <div>
                    <h3 style="font-size: 18px; font-weight: 800;">Growth Performance</h3>
                    <p style="font-size: 13px; color: var(--text-muted);">Monthly projections vs actual registration</p>
                </div>
                <div class="chart-tabs">
                    <div class="chart-tab">Month</div>
                    <div class="chart-tab active">Year</div>
                </div>
            </div>
            <div class="chart-container" style="position: relative; width: 100%; height: 200px;">
                <canvas id="chartPendaftaran"></canvas>
            </div>
        </div>
              
        <div class="activity-card glass">
            <h3 style="font-size: 18px; font-weight: 800; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-history"></i> Recent Activity
            </h3>
            <div class="activity-list" style="display: flex; flex-direction: column; gap: 16px;">
                <?php foreach (array_slice($pendaftaran_terbaru, 0, 4) as $p): ?>
                <div class="activity-item" style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div class="activity-icon"><i class="fas fa-user"></i></div>
                        <div>
                            <div class="activity-name" style="font-weight: 700; font-size: 14px;"><?= htmlspecialchars($p->nama_pasien) ?></div>
                            <div class="activity-time" style="font-size: 12px; color: var(--text-muted);"><?= date('d M, H:i', strtotime($p->created_at)) ?></div>
                        </div>
                    </div>
                    <?php if($p->status == 'disetujui'): ?>
                        <div class="activity-amount positive" style="font-weight: 700;">Disetujui</div>
                    <?php elseif($p->status == 'ditolak'): ?>
                        <div class="activity-amount negative" style="color:var(--accent-red); font-weight: 700;">Ditolak</div>
                    <?php else: ?>
                        <div class="activity-amount" style="color:var(--warning); font-weight: 700;">Menunggu</div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <a href="<?= base_url('admin/pendaftaran') ?>" class="view-all" style="display: block; text-align: center; margin-top: 24px; font-weight: 700; letter-spacing: 0.5px;">VIEW FULL LEDGER</a>
        </div>
    </div>

    <div class="tracking-row">
        <div class="track-card glass-pill">
            <div class="track-icon" style="background:#b45309"><i class="fas fa-stethoscope"></i></div>
            <div class="track-info">
                <div class="track-title">POLI UMUM</div>
                <div class="track-value" style="font-weight: 700;">Tersedia</div>
            </div>
            <div class="track-change positive">+1.2%</div>
        </div>
        
        <div class="track-card glass-pill">
            <div class="track-icon" style="background:#4338ca"><i class="fas fa-tooth"></i></div>
            <div class="track-info">
                <div class="track-title">POLI GIGI</div>
                <div class="track-value" style="font-weight: 700;">Tersedia</div>
            </div>
            <div class="track-change negative">-0.4%</div>
        </div>
        
        <div class="track-card glass-pill">
            <div class="track-icon" style="background:#b91c1c"><i class="fas fa-heartbeat"></i></div>
            <div class="track-info">
                <div class="track-title">IGD</div>
                <div class="track-value" style="font-weight: 700;">Aktif</div>
            </div>
            <div class="track-change positive">+2.5%</div>
        </div>
        
        <a href="<?= base_url('admin/pasien/tambah') ?>" class="track-card glass-pill add-track" style="text-decoration: none;">
            <div class="track-icon"><i class="fas fa-plus"></i></div>
            <div class="track-info">
                <div class="track-title" style="color:var(--text-main)">JALAN PINTAS</div>
                <div class="track-value" style="font-weight: 700;">Tambah Pasien</div>
            </div>
        </a>
    </div>

</div>

<script>
var monthlyData = <?= json_encode($monthly_stats) ?>;
var months = ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'];
var totals = new Array(12).fill(0);

monthlyData.forEach(function(d) {
    var parts = String(d.month).split('-');
    var idx = parts.length === 2 ? parseInt(parts[1], 10) - 1 : NaN;
    if (!isNaN(idx) && idx >= 0 && idx < totals.length) {
        totals[idx] += parseInt(d.total, 10) || 0;
    }
});

new Chart(document.getElementById('chartPendaftaran'), {
    type: 'bar',
    data: {
        labels: months.slice(0, 9),
        datasets: [{
            label: 'Registrations',
            data: totals.slice(0, 9),
            backgroundColor: 'rgba(255, 255, 255, 0.4)',
            hoverBackgroundColor: 'rgba(255, 255, 255, 0.8)',
            borderRadius: 50,
            borderSkipped: false,
            barThickness: 28 /* Batang diagram dipertebal karena layar lebih lebar */
        }]
    },
    options: { 
        responsive: true, 
        maintainAspectRatio: false,
        plugins: { legend: { display: false }}, 
        scales: { 
            y: { display: false, beginAtZero: true },
            x: { grid: { display: false }, ticks: { color: 'rgba(45, 55, 72, 0.6)', font: { size: 11, weight: 'bold', family: 'Plus Jakarta Sans' } }, border: { display: false } }
        }
    }
});
</script>
