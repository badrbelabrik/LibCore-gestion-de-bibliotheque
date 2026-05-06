<?php

namespace Entities;

class Book
{
    private string $isbn;
    private string $author;
    private string $state;
    private bool $isAvailable;

    public function __construct(string $isbn,string $author){
    $this->isbn = $isbn;
    $this->author = $author;
    $this->state = "disponible";
    $this->isAvailable = true;
    }

    public function getIsbn(): string
    }
}