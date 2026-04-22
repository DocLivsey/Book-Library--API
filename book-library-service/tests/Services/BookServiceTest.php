<?php

use PHPUnit\Framework\TestCase;
use App\Services\BookService;
use App\Repositories\BookRepository;

class BookServiceTest extends TestCase
{
    private $bookService;
    private $bookRepository;

    protected function setUp(): void
    {
        $this->bookRepository = $this->createMock(BookRepository::class);
        $this->bookService = new BookService($this->bookRepository);
    }

    public function testAddBook()
    {
        $bookData = [
            'user_id' => 1,
            'title' => 'Test Book',
            'author' => 'Author Name',
            'description' => 'Description of the test book',
            'status' => 'available'
        ];

        $this->bookRepository->expects($this->once())
            ->method('create')
            ->with($bookData)
            ->willReturn(true);

        $result = $this->bookService->addBook($bookData);
        $this->assertTrue($result);
    }

    public function testListBooks()
    {
        $books = [
            ['id' => 1, 'title' => 'Test Book 1'],
            ['id' => 2, 'title' => 'Test Book 2']
        ];

        $this->bookRepository->expects($this->once())
            ->method('findAll')
            ->willReturn($books);

        $result = $this->bookService->listBooks();
        $this->assertEquals($books, $result);
    }

    public function testGetBookDetails()
    {
        $bookId = 1;
        $book = ['id' => 1, 'title' => 'Test Book'];

        $this->bookRepository->expects($this->once())
            ->method('findById')
            ->with($bookId)
            ->willReturn($book);

        $result = $this->bookService->getBookDetails($bookId);
        $this->assertEquals($book, $result);
    }

    public function testModifyBook()
    {
        $bookId = 1;
        $bookData = ['title' => 'Updated Test Book'];

        $this->bookRepository->expects($this->once())
            ->method('update')
            ->with($bookId, $bookData)
            ->willReturn(true);

        $result = $this->bookService->modifyBook($bookId, $bookData);
        $this->assertTrue($result);
    }

    public function testRemoveBook()
    {
        $bookId = 1;

        $this->bookRepository->expects($this->once())
            ->method('delete')
            ->with($bookId)
            ->willReturn(true);

        $result = $this->bookService->removeBook($bookId);
        $this->assertTrue($result);
    }
}