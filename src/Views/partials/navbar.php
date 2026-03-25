<nav class="main-nav">
    <div class="container nav-wrap">
        <a href="<?= url('/') ?>" class="brand">🎓 University Course Hub</a>
        <div class="nav-links">
            <a href="<?= url('/') ?>">Home</a>
            <a href="<?= url('/programmes') ?>">Programmes</a>
            <?php if(\App\Core\Auth::check()): ?>
                <a href="<?= url('/admin/dashboard') ?>">Admin Dashboard</a>
            <?php else: ?>
                <a href="<?= url('/admin/login') ?>">Admin Login</a>
            <?php endif; ?>
            <?php if(\App\Core\StaffAuth::check()): ?>
                <a href="<?= url('/staff/dashboard') ?>">Staff Portal</a>
            <?php else: ?>
                <a href="<?= url('/staff/login') ?>">Staff Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
