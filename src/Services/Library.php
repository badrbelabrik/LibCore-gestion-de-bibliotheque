<?php

namespace Entities;

use PDOException;

class Library
{
    private string $name;
    private Connection $con;

    public function __construct(string $name,Connection $con){
        $this->con = $con;
        $this->name = $name;
    }
    public function addBook(Book $book):void{
        try{
            $sql = "INSERT INTO books (isbn, title, author) VALUES (?, ?, ?)";
            $stmt = $this->con->prepare($sql);
            $stmt->execute([$book->getIsbn(), $book->getTitle(), $book->getAuthor()]);

            echo "Book ".$book->getTitle()."added successfully !";
        } catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }
    }
    public function registerMember(Member $member):void{
        try{
            $sql = "INSERT INTO members (name,email,type) VALUES (?, ?, ?)";

            $stmt = $this->con->prepare($sql);
            $stmt->execute([$member->getName(),$member->getEmail(),$member->getType()]);

            echo "Member".$member->getName()."added successfully !";
        } catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }
    }

    public function showAllBooks(){
        try{
            $sql = "SELECT * FROM books";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }
        foreach($books as $book){
            echo "id: ".$book['id'];
            echo "isbn: ".$book['isbn'];
            echo "title: ".$book['title'];
            echo "author: " .$book['author'];
            echo "state: " .$book['state'];
        }
    }
    public function borrowBook(Member $member,Book $book):void{

    }
    public function returnBook(Member $Member,Book $Book):void{

    }
}