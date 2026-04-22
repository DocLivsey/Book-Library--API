<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Services\AuthService;

class AuthController
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function signUp(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $name = $data['name'] ?? '';
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        if (!$name || !$email || !$password) {
            return $response->withStatus(422)->withJson(['error' => 'Validation error']);
        }

        $user = $this->authService->register($name, $email, $password);
        if (!$user) {
            return $response->withStatus(422)->withJson(['error' => 'Email already exists']);
        }

        return $response->withJson(['auth_token' => $user->auth_token]);
    }

    public function signIn(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        if (!$email || !$password) {
            return $response->withStatus(422)->withJson(['error' => 'Validation error']);
        }

        $user = $this->authService->login($email, $password);
        if (!$user) {
            return $response->withStatus(401)->withJson(['error' => 'Invalid credentials']);
        }

        return $response->withJson(['auth_token' => $user->auth_token]);
    }
}
