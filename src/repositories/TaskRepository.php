<?php
namespace Src\Repositories;

use PDO;
use Src\Config\Database;
use Src\Models\Task;

class TaskRepository {
    private $connection;

    public function __construct() {
        $this->connection = Database::getConnection();
    }

    public function createTask(Task $task) {
        $now = date('Y-m-d H:i:s');
        $query = "INSERT INTO tasks (name, content, user_id, createdAt, updatedAt) VALUES (:name, :content, :user_id, :createdAt, :updatedAt)";
        $stmt = $this->connection->prepare($query);

        $stmt->bindValue(':name', $task->getName());
        $stmt->bindValue(':content', $task->getContent());
        $stmt->bindValue(':user_id', $task->getUserId(), PDO::PARAM_INT);
        $stmt->bindValue(':createdAt', $now);
        $stmt->bindValue(':updatedAt', $now);

        return $stmt->execute();
    }

    public function getAllTasks() {
        $query = "SELECT * FROM tasks";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findTaskById($id) {
        $query = "SELECT * FROM tasks WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchObject(Task::class);
    }

    public function findTasksByUserId($userId) {
        $query = "SELECT * FROM tasks WHERE user_id = :user_id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $tasks = [];
        while ($task = $stmt->fetchObject(Task::class)) {
            $tasks[] = $task;
        }

        return $tasks;
    }

    public function updateTask(Task $task) {
        $now = date('Y-m-d H:i:s');
        $query = "UPDATE tasks SET name = :name, content = :content, updatedAt = :updatedAt WHERE id = :id";
        $stmt = $this->connection->prepare($query);

        $stmt->bindValue(':name', $task->getName());
        $stmt->bindValue(':content', $task->getContent());
        $stmt->bindValue(':updatedAt', $now);
        $stmt->bindValue(':id', $task->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function deleteTask($id) {
        $query = "DELETE FROM tasks WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
