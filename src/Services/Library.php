<?php

namespace Entities;

class Library
{
    private string $name;
    private array $books;
    private array $users;
    private array $librarians;
    private array $members;

    public function __construct(string $name){
        $this->name = $name;
    }
    public function addBook(Book $book):void{
        array_push($this->books,$book);
    }
    public function registerMember(Member $member):void{
        array_push($this->members);
    }
    public function borrowBook(Member $member,Book $book):void{

    }
    public function returnBook(Member $Member,Book $Book):void{

    }
}