<?php

namespace Entities;

class Library
{
    private string $name;
    private Connection $con;
    private array $books;
    private array $users;
    private array $librarians;
    private array $members;

    public function __construct(string $name,Connection $con){
        $this->con = $con;
        $this->name = $name;
    }
    public function addBook(Book $book):void{
        $sql = "INSERT INTO books (isbn, title, author) VALUES (?, ?, ?)";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([$book->getIsbn(), $book->getTitle(), $book->getAuthor()]);

        echo "Book ".$book->getTitle()."added successfully !";
    }
    public function registerMember(Member $member):void{
        $sql = "INSERT INTO members ()"
    }
    public function borrowBook(Member $member,Book $book):void{

    }
    public function returnBook(Member $Member,Book $Book):void{

    }
}