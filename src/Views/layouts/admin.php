<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Admin Dashboard') ?></title>
    <link rel="stylesheet" href="<?= url('/assets/css/app.css') ?>">
</head>
<body class="admin-body">
    <?php if (\App\Core\Auth::check()): ?>
        <nav class="admin-nav">
            <div class="container nav-wrap">
                <a href="<?= url('/admin/dashboard') ?>" class="brand">Admin Panel</a>
                <div class="nav-links">
                    <a href="<?= url('/') ?>">View Site</a>
                    <a href="<?= url('/admin/programmes') ?>">Programmes</a>
                    <a href="<?= url('/admin/modules') ?>">Modules</a>
                    <a href="<?= url('/admin/assignments') ?>">Assignments</a>
                    <a href="<?= url('/admin/mailing') ?>">Mailing List</a>
                    <a href="<?= url('/admin/staff') ?>">Staff</a>
                    <a href="<?= url('/admin/logout') ?>">Logout</a>
                </div>
            </div>
        </nav>
    <?php endif; ?>

    <div class="container admin-content">
        <?php require __DIR__ . '/../partials/flash.php'; ?>
        
        <?= $content ?? '' ?>
    </div>
</body>
</html>
