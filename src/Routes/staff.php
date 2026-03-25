<?php

use App\Controllers\Staff\AuthController;
use App\Controllers\Staff\DashboardController;

$router->get('/staff/login', [AuthController::class, 'loginForm']);
$router->post('/staff/login', [AuthController::class, 'login']);
$router->get('/staff/logout', [AuthController::class, 'logout']);

$router->get('/staff', [DashboardController::class, 'index']);
$router->get('/staff/dashboard', [DashboardController::class, 'index']);
