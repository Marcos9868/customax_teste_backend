<?php
namespace Src\Services;

use Src\Models\User;
use Src\Repositories\UserRepository;

class UserService {
    private $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function getAllUsers() {
        return $this->userRepository->findAllUsers();
    }

    public function getUserById($id) {
        return $this->userRepository->findUserById($id);
    }

    public function createUser($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setPassword($hashedPassword);

        return $this->userRepository->createUser($user);
    }

    public function updateUser($id, $name, $email, $password = null) {
        $user = new User();
        $user->setId($id);
        $user->setName($name);
        $user->setEmail($email);
        if ($password) {
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
        }

        return $this->userRepository->updateUser($user);
    }

    public function deleteUser($id) {
        return $this->userRepository->deleteUser($id);
    }
}
