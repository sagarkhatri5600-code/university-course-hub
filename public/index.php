<?php

require_once __DIR__ . '/../src/Helpers/functions.php';
require_once __DIR__ . '/../src/Helpers/validators.php';

spl_autoload_register(function ($class) {
    $prefix = 'App\\';

    $base_dir = __DIR__ . '/../src/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);

    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

loadEnv(__DIR__ . '/../.env');

$app = new \App\Core\App();
$router = $app->getRouter();

require_once __DIR__ . '/../src/Routes/web.php';
require_once __DIR__ . '/../src/Routes/admin.php';
require_once __DIR__ . '/../src/Routes/staff.php';

$app->run();
