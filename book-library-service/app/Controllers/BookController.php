<?php

namespace App\Controllers;

use App\Services\BookService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BookController
{
    private $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function createBook(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        $book = $this->bookService->addBook($data);
        $response->getBody()->write(json_encode($book));
        return $response->withStatus(201)->withHeader('Content-Type', 'application/json');
    }

    public function getBooks(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $books = $this->bookService->listBooks();
        $response->getBody()->write(json_encode($books));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function getBook(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $book = $this->bookService->getBookDetails($args['id']);
        if ($book) {
            $response->getBody()->write(json_encode($book));
            return $response->withHeader('Content-Type', 'application/json');
        }
        return $response->withStatus(404);
    }

    public function updateBook(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        $book = $this->bookService->modifyBook($args['id'], $data);
        if ($book) {
            $response->getBody()->write(json_encode($book));
            return $response->withHeader('Content-Type', 'application/json');
        }
        return $response->withStatus(404);
    }

    public function deleteBook(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $success = $this->bookService->removeBook($args['id']);
        if ($success) {
            return $response->withStatus(204);
        }
        return $response->withStatus(404);
    }
}