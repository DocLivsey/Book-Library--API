<?php

namespace App\Models;

class Book
{
    private $id;
    private $user_id;
    private $title;
    private $author;
    private $description;
    private $status;
    private $created_at;
    private $updated_at;

    public function __construct($user_id, $title, $author, $description, $status)
    {
        $this->user_id = $user_id;
        $this->title = $title;
        $this->author = $author;
        $this->description = $description;
        $this->status = $status;
        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function update($title, $author, $description, $status)
    {
        $this->title = $title;
        $this->author = $author;
        $this->description = $description;
        $this->status = $status;
        $this->updated_at = new \DateTime();
    }
}