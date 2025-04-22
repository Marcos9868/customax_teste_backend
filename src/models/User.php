<?php
namespace Src\Models;
class User {
    private $id;
    private $name;
    private $email;
    private $password;
    private $createdAt;

    // Construtor para inicializar as propriedades
    public function __construct($name, $email, $password, $createdAt = null) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = $createdAt ?? date('Y-m-d H:i:s'); // Se não for passado, usa a data e hora atual
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'createdAt' => $this->createdAt
        ];
    }
}
?>
