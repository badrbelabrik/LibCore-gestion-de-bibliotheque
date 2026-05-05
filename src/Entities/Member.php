<?php

namespace Entities;

class Member extends User
{
    private static int $nextId = 1;
    private int $id;
    private string $type;

    public function __construct(string $name,string $email,string $type){
        $this->id = self::$nextId++;
        parent::__construct($name,$email);
        $this->type = $type;
    }
    public function borrowBook(Book $book):void{

    }
    public function returnBook(Book $book):void{

    }
}