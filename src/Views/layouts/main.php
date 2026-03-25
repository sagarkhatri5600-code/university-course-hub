<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'University Course Portal') ?></title>
    <link rel="stylesheet" href="<?= url('/assets/css/app.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php require __DIR__ . '/../partials/navbar.php'; ?>
    
    <div class="container main-content">
        <?php require __DIR__ . '/../partials/flash.php'; ?>
        
        <?= $content ?? '' ?>
    </div>

    <footer class="site-footer">
        <div class="container">
            <p>&copy; <?= date('Y') ?> University Course Portal. All rights reserved.</p>
        </div>
    </footer>

    <script src="<?= url('/assets/js/app.js') ?>"></script>
</body>
</html>
