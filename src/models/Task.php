<?php
namespace Src\Models;

class Task {
    private $id;
    private $name;
    private $content;
    private $userId;
    private $createdAt;
    private $updatedAt;

    public function __construct($name = null, $content = null, $userId = null, $createdAt = null, $updatedAt = null) {
        $this->name = $name;
        $this->content = $content;
        $this->userId = $userId;
        $this->createdAt = $createdAt ?? date('Y-m-d H:i:s'); // Se não for passado, usa a data e hora atual
        $this->updatedAt = $updatedAt ?? date('Y-m-d H:i:s'); // Se não for passado, usa a data e hora atual
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

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }
    public function getUserId() {
        return $this->userId;
    }
    public function setUserId($userId) {
        $this->userId = $userId;
    }
    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;
    }

    // Método para representar a tarefa como um array (útil para o retorno de dados)
    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'content' => $this->content,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt
        ];
    }
}

