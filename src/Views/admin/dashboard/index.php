<div class="dashboard-header">
    <h1>Dashboard Overview</h1>
    <p>Welcome back, <?= htmlspecialchars(\App\Core\Auth::user()['username']) ?></p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <h3>Total Programmes</h3>
        <p class="stat-number"><?= $stats['programmes'] ?></p>
        <a href="<?= url('/admin/programmes') ?>" class="btn btn-sm btn-outline">Manage</a>
    </div>
    <div class="stat-card">
        <h3>Total Modules</h3>
        <p class="stat-number"><?= $stats['modules'] ?></p>
        <a href="<?= url('/admin/modules') ?>" class="btn btn-sm btn-outline">Manage</a>
    </div>
    <div class="stat-card">
        <h3>Interested Students</h3>
        <p class="stat-number"><?= $stats['interests'] ?></p>
        <a href="<?= url('/admin/mailing') ?>" class="btn btn-sm btn-outline">View List</a>
    </div>
</div>
