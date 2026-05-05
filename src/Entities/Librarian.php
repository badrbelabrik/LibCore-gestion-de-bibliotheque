<?php

namespace Entities;

class Librarian
{   private static int $nextId = 1;
    private int $id;
    public function __construct(){
        $this->id = self::$nextId++;
    }
    public function registerMember(Member $member):void{

    }
    public function addBook(Book $book):void{

    }
}