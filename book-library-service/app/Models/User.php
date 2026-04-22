<?php
namespace App\Models;

class User
{
    public int $id;
    public string $name;
    public string $email;
    public string $password_hash;
    public string $auth_token;
    public string $created_at;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? 0;
        $this->name = $data['name'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->password_hash = $data['password_hash'] ?? '';
        $this->auth_token = $data['auth_token'] ?? '';
        $this->created_at = $data['created_at'] ?? '';
    }
}
