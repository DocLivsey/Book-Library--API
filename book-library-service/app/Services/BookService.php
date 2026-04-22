<?php

namespace App\Services;

use App\Repositories\BookRepository;

class BookService
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function addBook(array $data)
    {
        return $this->bookRepository->create($data);
    }

    public function listBooks($userId)
    {
        return $this->bookRepository->findAll($userId);
    }

    public function getBookDetails($id)
    {
        return $this->bookRepository->findById($id);
    }

    public function modifyBook($id, array $data)
    {
        return $this->bookRepository->update($id, $data);
    }

    public function removeBook($id)
    {
        return $this->bookRepository->delete($id);
    }
}