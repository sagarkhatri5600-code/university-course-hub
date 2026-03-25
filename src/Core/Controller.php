<?php

namespace App\Core;

class Controller
{
    protected function render(string $view, array $data = []): string
    {
        return View::render($view, $data);
    }

    protected function redirect(string $url): void
    {
        if (strpos($url, 'http') !== 0) {
            $url = url($url);
        }
        header("Location: $url");
        exit;
    }
}
