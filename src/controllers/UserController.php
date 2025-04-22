<?php
namespace Src\Controllers;

use Src\Services\UserService;

class UserController {
    private $userService;
    public function __construct() {
        $this->userService = new UserService();
    }
    public function getAllUsers() {
        $users = $this->userService->getAllUsers();
        echo json_encode($users);
    }
    public function getUser($id) {
        $user = $this->userService->getUserById($id);
        echo json_encode($user);
    }
    public function createUser($name, $email, $password) {
        $newUser = $this->userService->createUser($name, $email, $password);
        echo json_encode($newUser);
    }
    public function updateUser($id, $name, $email) {
        $updated = $this->userService->updateUser($id, $name, $email);
        echo json_encode($updated);
    }
    public function deleteUser($id) {
        $deleted = $this->userService->deleteUser($id);
        echo json_encode(['deleted' => $deleted]);
    }
}
