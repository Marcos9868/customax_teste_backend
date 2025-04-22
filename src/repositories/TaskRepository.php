<?php
namespace Src\Repositories;

use Src\Config\Database;
use Src\Models\Task;

class TaskRepository {
    private $connection;

    public function __construct() {
        $this->connection = Database::getConnection(); // Obtém a conexão com o banco de dados
    }
    public function createTask(Task $task) {
        $query = "INSERT INTO tasks (name, content, user_id, createdAt, updatedAt) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param(
            "ssiss",
            $task->getName(),
            $task->getContent(),
            $task->getUserId(),
            $task->getCreatedAt(),
            $task->getUpdatedAt()
        );
        return $stmt->execute();
    }
    public function getAllTasks() {
        $query = "SELECT * FROM tasks";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }
    public function findTaskById($id) {
        $query = "SELECT * FROM tasks WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_object('Src\Models\Task');
    }
    public function findTasksByUserId($userId) {
        $query = "SELECT * FROM tasks WHERE user_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $tasks = [];
        while ($task = $result->fetch_object('Src\Models\Task')) {
            $tasks[] = $task;
        }
        return $tasks;
    }
    public function updateTask(Task $task) {
        $query = "UPDATE tasks SET name = ?, content = ?, updatedAt = ? WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param(
            "sssi",
            $task->getName(),
            $task->getContent(),
            $task->getUpdatedAt(),
            $task->getId()
        );
        return $stmt->execute();
    }
    public function deleteTask($id) {
        $query = "DELETE FROM tasks WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
