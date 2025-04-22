<?php
namespace Src\Routes;

use Src\Controllers\TaskController;

// Para aceitar JSON de entrada
header("Content-Type: application/json");

// Cria a instância do controller
$taskController = new TaskController();

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($method === 'GET' && preg_match('/\/tasks$/', $uri)) {
    $taskController->getAllTasks();
}

if ($method === 'GET' && isset($_GET['user_id'])) {
    $taskController->getTasksByUser($_GET['user_id']);
}

if ($method === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);
    if (isset($input['name'], $input['content'], $input['user_id'])) {
        $taskController->createTask($input['name'], $input['content'], $input['user_id']);
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Missing fields"]);
    }
}

if ($method === 'PUT' && isset($_GET['task_id'])) {
    $input = json_decode(file_get_contents("php://input"), true);
    if (isset($input['name'], $input['content'])) {
        $taskController->updateTask($_GET['task_id'], $input['name'], $input['content']);
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Missing fields"]);
    }
}

if ($method === 'DELETE' && isset($_GET['task_id'])) {
    $taskController->deleteTask($_GET['task_id']);
}
