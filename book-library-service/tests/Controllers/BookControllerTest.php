<?php

use PHPUnit\Framework\TestCase;
use App\Controllers\BookController;
use App\Services\BookService;

class BookControllerTest extends TestCase
{
    protected $bookController;
    protected $bookService;

    protected function setUp(): void
    {
        $this->bookService = $this->createMock(BookService::class);
        $this->bookController = new BookController($this->bookService);
    }

    public function testCreateBook()
    {
        $this->bookService->method('addBook')->willReturn(true);
        $request = $this->createMock(\Psr\Http\Message\ServerRequestInterface::class);
        $response = $this->bookController->createBook($request);
        $this->assertEquals(201, $response->getStatusCode());
    }

    public function testGetBooks()
    {
        $this->bookService->method('listBooks')->willReturn([]);
        $response = $this->bookController->getBooks();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetBook()
    {
        $this->bookService->method('getBookDetails')->willReturn(['id' => 1, 'title' => 'Test Book']);
        $response = $this->bookController->getBook(1);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUpdateBook()
    {
        $this->bookService->method('modifyBook')->willReturn(true);
        $request = $this->createMock(\Psr\Http\Message\ServerRequestInterface::class);
        $response = $this->bookController->updateBook(1, $request);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testDeleteBook()
    {
        $this->bookService->method('removeBook')->willReturn(true);
        $response = $this->bookController->deleteBook(1);
        $this->assertEquals(204, $response->getStatusCode());
    }
}