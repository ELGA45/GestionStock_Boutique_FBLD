<?php
session_start();
require_once __DIR__ . '/../../src/controllers/ClientController.php';

$controller = new ClientController();
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;
$message = $_GET['m'] ?? null;
$messageClass = $_GET['mc'] ?? null;

switch ($action) {
    case 'addForm':
            $controller->addForm($message, $messageClass);
        break;
    case 'add':
            $controller->add();
        break;
    case 'editForm':
            if ($id) {
              $controller->editForm($id, $message, $messageClass);
            }
        break;
    case 'update':
            $controller->update($_POST['id']);
        break;
    case 'deleteForm':
            if ($id) {
              $controller->deleteForm($id);
            }
        break;
    case 'delete':
            $controller->delete($_POST['id'], $_POST['confirm']);
        break;
    default:
            $controller->index();
        break;
}