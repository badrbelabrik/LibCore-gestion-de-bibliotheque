<?php

namespace Entities;

class Library
{
    private string $name;
    private array $books;
    private array $users;

    public function __construct(string $name){
        $this->name = $name;
    }
    public function addBook(Book $book):void{

    }
    public function registerMember(Member $member):void{

    }
    public function borrowBook(Member $member,Book $book):void{

    }
    public function returnBook(Member $Member,Book $Book):void{

    }
}