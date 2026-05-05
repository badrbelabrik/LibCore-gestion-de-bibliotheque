<?php

namespace Entities;

class Book
{
    private static int $nextId = 1;
    private string $isbn;
    private int $id;
    private string $author;
    private string $state;
    private bool $isAvailable;

    public function __construct(string $isbn,string $author){
    $this->isbn = $isbn;
    $this->id = self::$nextId++;
    $this->author = $author;
    $this->state = "disponible";
    $this->isAvailable = true;
    }
}