<?php

namespace Entities;

class Book
{
    private string $isbn;
    private  string $title;
    private string $author;
    private string $state;
    private bool $isAvailable;

    public function __construct(string $isbn,string $title,string $author){
    $this->isbn = $isbn;
    $this->title = $title;
    $this->author = $author;
    $this->state = "disponible";
    $this->isAvailable = true;
    }

    public function getIsbn(): string{
        return $this->isbn;
    }
    public function getTitle(): string{
        return $this->title;
    }
    public function getAuthor(): string{
        return $this->author;
    }
    public function getState(): string{
        return $this->state;
    }
    public function isAvailable(): bool{
        return $this->isAvailable;
    }
    public function setIsAvailable(bool $status): void{
        $this->isAvailable = $status;
    }
    public function setState(string $state): void{
        $this->state = $state;
    }

}