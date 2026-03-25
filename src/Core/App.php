<?php

namespace App\Core;

class App
{
    protected Router $router;

    public function __construct()
    {
        $this->router = new Router();
        Session::start();
    }

    public function getRouter(): Router
    {
        return $this->router;
    }

    public function run(): void
    {
        try {
            echo $this->router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
        } catch (\Exception $e) {
            http_response_code(404);
            echo View::render('layouts/main', ['content' => "<h1>404 Not Found</h1><p>{$e->getMessage()}</p>"]);
        }
    }
}
