<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Staff Portal') ?></title>
    <link rel="stylesheet" href="<?= url('/assets/css/app.css') ?>">
</head>
<body class="admin-body staff-body">
    <?php if (\App\Core\StaffAuth::check()): ?>
        <nav class="admin-nav staff-nav">
            <div class="container nav-wrap">
                <a href="<?= url('/staff/dashboard') ?>" class="brand">Staff Portal</a>
                <div class="nav-links">
                    <a href="<?= url('/') ?>">View Site</a>
                    <a href="<?= url('/staff/logout') ?>">Logout</a>
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
