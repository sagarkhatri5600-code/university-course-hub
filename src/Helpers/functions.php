<?php

if (!function_exists('env')) {
    function env(string $key, $default = null) {
        if (array_key_exists($key, $_ENV)) {
            return $_ENV[$key];
        }
        if (array_key_exists($key, $_SERVER)) {
            return $_SERVER[$key];
        }
        $val = getenv($key);
        return $val !== false ? $val : $default;
    }
}

function loadEnv(string $path) {
    if (!file_exists($path)) return;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv(sprintf('%s=%s', $name, $value));
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}

if (!function_exists('url')) {
    function url(string $path = ''): string {
        $baseDir = dirname($_SERVER['SCRIPT_NAME']);
        $baseDir = str_replace('\\', '/', $baseDir);

        if ($baseDir === '/') {
            $baseDir = '';
        }

        $path = ltrim($path, '/');
        return $baseDir . '/' . $path;
    }
}
