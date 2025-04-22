<?php

namespace Src\Services;

use Src\Repositories\TaskRepository;
use Src\Models\Task;

class TaskService {
    private $taskRepository;

    public function __construct() {
        $this->taskRepository = new TaskRepository();
    }
    public function createTask($name, $content, $userId) {
        // Lógica de negócio (se necessário)
        $task = new Task($name, $content, $userId);
        $task->setCreatedAt(date('Y-m-d H:i:s'));
        $task->setUpdatedAt(date('Y-m-d H:i:s'));

        return $this->taskRepository->createTask($task);
    }
    public function updateTask($id, $name, $content) {
        $task = $this->taskRepository->findTaskById($id);

        if ($task) {
            $task->setName($name);
            $task->setContent($content);
            $task->setUpdatedAt(date('Y-m-d H:i:s'));

            return $this->taskRepository->updateTask($task);
        }

        return false;
    }
    public function deleteTask($id) {
        return $this->taskRepository->deleteTask($id);
    }
    public function getTasksByUser($userId) {
        return $this->taskRepository->findTasksByUserId($userId);
    }
    public function getAllTasks() {
        return $this->taskRepository->getAllTasks();
    }
}
