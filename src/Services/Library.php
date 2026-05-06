<?php

namespace Entities;

class Library
{
    private string $name;
    private array $books;
    private array $users;

    public function __construct(string $name){
        $this->name = $name;
        $this->books = [];
        $this->users = [];
    }
    public function addBook(Book $book):void{
        $this->books[] = $book;

    }
    public function registerMember(Member $member):void{
        $this->users[] = $member;

    }
    public function borrowBook(Member $member,Book $book):void{
        if($book->isAvailable()){
            $member->borrowBook($book);
        }else{
            echo "Book is not available";
        }

    }
    public function returnBook(Member $Member,Book $Book):void{
        $Member->returnBook($Book);

    }
    public function searchBook(string $Keyword):array
    {
        $result = [];
        foreach ($this->books as $book) {
            if (
                stripos($book->getitle(), $Keyword) !== false ||
                stripos($book->geAuthor(), $Keyword) !== false
            ) {
                $result[] = $book;
            }
        }
        return $result;

    }

}