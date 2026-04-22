<?php

namespace App\Repositories;

use App\Models\Book;
use PDO;

class BookRepository
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function findAll($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Book::class);
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetchObject(Book::class);
    }

    public function create(Book $book)
    {
        $stmt = $this->db->prepare("INSERT INTO books (user_id, title, author, description, status, created_at, updated_at) VALUES (:user_id, :title, :author, :description, :status, :created_at, :updated_at)");
        $stmt->execute([
            'user_id' => $book->user_id,
            'title' => $book->title,
            'author' => $book->author,
            'description' => $book->description,
            'status' => $book->status,
            'created_at' => $book->created_at,
            'updated_at' => $book->updated_at,
        ]);
        return $this->db->lastInsertId();
    }

    public function update(Book $book)
    {
        $stmt = $this->db->prepare("UPDATE books SET title = :title, author = :author, description = :description, status = :status, updated_at = :updated_at WHERE id = :id");
        $stmt->execute([
            'id' => $book->id,
            'title' => $book->title,
            'author' => $book->author,
            'description' => $book->description,
            'status' => $book->status,
            'updated_at' => $book->updated_at,
        ]);
        return $stmt->rowCount();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM books WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount();
    }
}