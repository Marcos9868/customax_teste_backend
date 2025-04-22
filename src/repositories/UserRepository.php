<?php
namespace Src\Repositories;

use PDO;
use Src\Config\Database;
use Src\Models\User;

class UserRepository {
    private $connection;

    public function __construct() {
        $this->connection = Database::getConnection();
    }

    public function createUser(User $user) {
        $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':name', $user->getName());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->execute();

        return $this->connection->lastInsertId(); // Retorna ID criado
    }

    public function findAllUsers() {
        $query = "SELECT * FROM users";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Ideal para API JSON
    }

    public function findUserById($id) {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findUserByEmail($email) {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser(User $user) {
        $query = "UPDATE users SET name = :name, email = :email";

        // Só atualiza a senha se ela for enviada
        if ($user->getPassword()) {
            $query .= ", password = :password";
        }

        $query .= " WHERE id = :id";

        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':name', $user->getName());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':id', $user->getId(), PDO::PARAM_INT);

        if ($user->getPassword()) {
            $stmt->bindValue(':password', $user->getPassword());
        }

        return $stmt->execute();
    }

    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
