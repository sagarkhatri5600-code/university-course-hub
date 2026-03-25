<?php

namespace App\Core;

class View
{
    public static function render(string $viewPath, array $data = []): string
    {
        extract($data);

        ob_start();
        $file = __DIR__ . '/../Views/' . $viewPath . '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            throw new \Exception("View file not found: $file");
        }
        $content = ob_get_clean();

        if (strpos($viewPath, 'layouts/') !== 0 && strpos($viewPath, 'partials/') !== 0) {
            if (strpos($viewPath, 'admin/') === 0) {
                $layoutPath = 'layouts/admin';
            } elseif (strpos($viewPath, 'staff/') === 0) {
                $layoutPath = 'layouts/staff';
            } else {
                $layoutPath = 'layouts/main';
            }
            $layoutFile = __DIR__ . '/../Views/' . $layoutPath . '.php';
            
            if (file_exists($layoutFile)) {
                ob_start();
                require $layoutFile;
                return ob_get_clean();
            }
        }

        return $content;
    }
}
