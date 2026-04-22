<?php
namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Services\AuthService;

class AuthMiddleware
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function __invoke(Request $request, Response $response, callable $next)
    {
        $authHeader = $request->getHeaderLine('Authorization');
        if (!$authHeader || !preg_match('/Bearer\s+(\S+)/', $authHeader, $matches)) {
            return $response->withStatus(401)->withJson(['error' => 'No auth token']);
        }
        $token = $matches[1];
        $user = $this->authService->getUserByToken($token);
        if (!$user) {
            return $response->withStatus(401)->withJson(['error' => 'Invalid token']);
        }
        $request = $request->withAttribute('user', $user);
        return $next($request, $response);
    }
}
