<?php
namespace App\Repositories;

use App\Models\User;
use PDO;

class UserRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function findByEmail(string $email): ?User
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new User($data) : null;
    }

    public function findByToken(string $token): ?User
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE auth_token = :token');
        $stmt->execute(['token' => $token]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new User($data) : null;
    }

    public function create(string $name, string $email, string $password_hash, string $auth_token): User
    {
        $stmt = $this->db->prepare('INSERT INTO users (name, email, password_hash, auth_token, created_at) VALUES (:name, :email, :password_hash, :auth_token, NOW())');
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password_hash' => $password_hash,
            'auth_token' => $auth_token
        ]);
        $id = (int)$this->db->lastInsertId();
        return new User([
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'password_hash' => $password_hash,
            'auth_token' => $auth_token,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
