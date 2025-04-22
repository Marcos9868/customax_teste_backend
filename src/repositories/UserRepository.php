<?php
namespace Src\Repositories;

use Src\Config\Database;
use Src\Models\User;

class UserRepository {
    private $connection;
    public function __construct() {
        $this->connection = Database::getConnection(); // Obtém a conexão do banco de dados
    }
    public function createUser(User $user) {
        $query = "INSERT INTO users (name, email, password, createdAt) VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ssss", $user->getName(), $user->getEmail(), password_hash($user->getPassword(), PASSWORD_DEFAULT), $user->getCreatedAt());
        return $stmt->execute();
    }
    public function findUserById($id) {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_object('User');
    }
    public function findUserByEmail($email) {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_object('User');
    }
    public function updateUser(User $user) {
        $query = "UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sssi", $user->getName(), $user->getEmail(), password_hash($user->getPassword(), PASSWORD_DEFAULT), $user->getId());
        return $stmt->execute();
    }
    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
