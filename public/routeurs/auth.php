<?php
session_start();
require_once __DIR__ . '/../../src/controllers/AuthController.php';

$controller = new AuthController();
$action = $_GET['action'] ?? 'loginForm';

switch ($action) {
    case 'login':
            $controller->login($_POST['email'], $_POST['password']);
        break;
    case 'logoutForm':
            $controller->logoutForm();
        break;
    case 'logout':
            $controller->logout($_POST['confirm']);
        break;
    default:
            $controller->loginForm();
        break;
}