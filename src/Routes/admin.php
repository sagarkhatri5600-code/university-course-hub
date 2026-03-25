<?php

use App\Controllers\Admin\AuthController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\ProgrammeController;
use App\Controllers\Admin\ModuleController;
use App\Controllers\Admin\AssignmentController;
use App\Controllers\Admin\MailingController;
use App\Controllers\Admin\StaffController;

$router->get('/admin/login', [AuthController::class, 'loginForm']);
$router->post('/admin/login', [AuthController::class, 'login']);
$router->get('/admin/logout', [AuthController::class, 'logout']);

$router->get('/admin', [DashboardController::class, 'index']);
$router->get('/admin/dashboard', [DashboardController::class, 'index']);

$router->get('/admin/programmes', [ProgrammeController::class, 'index']);
$router->get('/admin/programmes/create', [ProgrammeController::class, 'create']);
$router->post('/admin/programmes/store', [ProgrammeController::class, 'store']);
$router->get('/admin/programmes/edit/{id}', [ProgrammeController::class, 'edit']);
$router->post('/admin/programmes/update/{id}', [ProgrammeController::class, 'update']);
$router->post('/admin/programmes/delete/{id}', [ProgrammeController::class, 'delete']);

$router->get('/admin/modules', [ModuleController::class, 'index']);
$router->get('/admin/modules/create', [ModuleController::class, 'create']);
$router->post('/admin/modules/store', [ModuleController::class, 'store']);
$router->get('/admin/modules/edit/{id}', [ModuleController::class, 'edit']);
$router->post('/admin/modules/update/{id}', [ModuleController::class, 'update']);
$router->post('/admin/modules/delete/{id}', [ModuleController::class, 'delete']);

$router->get('/admin/assignments', [AssignmentController::class, 'index']);
$router->post('/admin/assignments/store', [AssignmentController::class, 'store']);
$router->post('/admin/assignments/delete/{id}', [AssignmentController::class, 'delete']);

$router->get('/admin/mailing', [MailingController::class, 'index']);
$router->get('/admin/mailing/export', [MailingController::class, 'export']);

$router->get('/admin/staff', [StaffController::class, 'index']);
$router->get('/admin/staff/create', [StaffController::class, 'create']);
$router->post('/admin/staff/store', [StaffController::class, 'store']);
$router->get('/admin/staff/edit/{id}', [StaffController::class, 'edit']);
$router->post('/admin/staff/update/{id}', [StaffController::class, 'update']);
$router->post('/admin/staff/delete/{id}', [StaffController::class, 'delete']);
