<?php
namespace App\Services;

use App\Repositories\UserRepository;
use App\Models\User;

class AuthService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(string $name, string $email, string $password): ?User
    {
        if ($this->userRepository->findByEmail($email)) {
            return null; // Email already exists
        }
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $auth_token = bin2hex(random_bytes(32));
        return $this->userRepository->create($name, $email, $password_hash, $auth_token);
    }

    public function login(string $email, string $password): ?User
    {
        $user = $this->userRepository->findByEmail($email);
        if ($user && password_verify($password, $user->password_hash)) {
            return $user;
        }
        return null;
    }

    public function getUserByToken(string $token): ?User
    {
        return $this->userRepository->findByToken($token);
    }
}
