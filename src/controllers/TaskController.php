<?php

namespace Src\Controllers;

use Src\Services\TaskService;

class TaskController {
    private $taskService;

    public function __construct() {
        $this->taskService = new TaskService();
    }
    public function createTask($name, $content, $userId) {
        if (empty($name) || empty($content) || empty($userId)) {
            echo "All fields are required.";
            return;
        }
        if ($this->taskService->createTask($name, $content, $userId)) {
            echo "Task created successfully!";
        } else {
            echo "Failed to create task!";
        }
    }
    public function updateTask($id, $name, $content) {
        if (empty($id) || empty($name) || empty($content)) {
            echo "All fields are required.";
            return;
        }

        if ($this->taskService->updateTask($id, $name, $content)) {
            echo "Task updated successfully!";
        } else {
            echo "Failed to update task!";
        }
    }
    public function deleteTask($id) {
        if (empty($id)) {
            echo "Task ID is required.";
            return;
        }

        if ($this->taskService->deleteTask($id)) {
            echo "Task deleted successfully!";
        } else {
            echo "Failed to delete task!";
        }
    }
    public function getTasksByUser($userId) {
        if (empty($userId)) {
            echo "User ID is required.";
            return;
        }

        $tasks = $this->taskService->getTasksByUser($userId);
        
        if (empty($tasks)) {
            echo "No tasks found.";
            return;
        }

        foreach ($tasks as $task) {
            echo "Task: " . $task->getName() . "<br>";
            echo "Content: " . $task->getContent() . "<br>";
        }
    }
    public function getAllTasks() {
        $tasks = $this->taskService->getAllTasks();

        echo json_encode($tasks);
    }
}
