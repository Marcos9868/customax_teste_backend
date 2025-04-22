<?php
namespace Src\Routes;

use Src\Controllers\UserController;

$controller = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller->getAllUsers();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $controller->getUser($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (!$input || !isset($input['name'], $input['email'], $input['password'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing required fields']);
        exit;
    }

    $userController = new UserController();
    $userController->createUser($input['name'], $input['email'], $input['password']);
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['id'])) {
    parse_str(file_get_contents("php://input"), $_PUT);
    $controller->updateUser($_GET['id'], $_PUT['name'], $_PUT['email']);
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
    $controller->deleteUser($_GET['id']);
}
