<?php
namespace Src\Routes;

use Src\Controllers\TaskController;

$taskController = new TaskController();

// Rota para obter todas as tarefas
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['user_id'])) {
    $taskController->getAllTasks(); // Busca todas as tasks
}

// Rota para obter as tarefas de um usuário específico
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['user_id'])) {
    $taskController->getTasksByUser($_GET['user_id']); // Busca tasks de um usuário
}

// Rota para criar uma nova tarefa
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['content'], $_POST['user_id'])) {
    // Verifica se os parâmetros necessários estão presentes
    $taskController->createTask($_POST['name'], $_POST['content'], $_POST['user_id']);
}

// Rota para atualizar uma tarefa existente
if ($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['task_id'])) {
    parse_str(file_get_contents("php://input"), $_PUT);  // Lê os dados do PUT
    if (isset($_PUT['name'], $_PUT['content'])) {  // Verifica se os dados necessários estão no corpo
        $taskController->updateTask($_GET['task_id'], $_PUT['name'], $_PUT['content']);
    }
}

// Rota para excluir uma tarefa
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['task_id'])) {
    $taskController->deleteTask($_GET['task_id']); // Exclui a tarefa com o ID fornecido
}
