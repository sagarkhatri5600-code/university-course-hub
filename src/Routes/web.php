<?php

use App\Controllers\HomeController;
use App\Controllers\ProgrammeController;
use App\Controllers\InterestController;

$router->get('/', [HomeController::class, 'index']);
$router->get('/programmes', [ProgrammeController::class, 'index']);
$router->get('/programme/{id}', [ProgrammeController::class, 'show']);

$router->post('/interest/register', [InterestController::class, 'store']);
$router->post('/interest/withdraw', [InterestController::class, 'withdraw']);
