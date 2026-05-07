<?php

namespace Services;

use Entities\Book;
use Entities\Member;
use PDO;
use PDOException;

class Library
{
    private string $name;
    private PDO $con;

    public function __construct(string $name,PDO $con){
        $this->con = $con;
        $this->name = $name;
    }
    public function addBook(Book $book):void{
        try{
            $sql = "INSERT INTO books (isbn, title, author) VALUES (?, ?, ?)";
            $stmt = $this->con->prepare($sql);
            $stmt->execute([$book->getIsbn(), $book->getTitle(), $book->getAuthor()]);

            echo "Book ".$book->getTitle()."added successfully ! \n";
        } catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }
    }

    public function deleteBook($id):void{
        try{
            $sql = "DELETE FROM books WHERE id = ?";
            $stmt = $this->con->prepare($sql);
            $stmt->execute([$id]);
            echo"Book deleted successfully ! \n";
        } catch(PDOException $e){
            echo "Error :".$e->getMessage();
        }



    }
    public function registerMember(Member $member):void{
        try{
            $sql = "INSERT INTO members (name,email,member_type) VALUES (?, ?, ?)";

            $stmt = $this->con->prepare($sql);
            $stmt->execute([$member->getName(),$member->getEmail(),$member->getType()]);

            echo "Member ".$member->getName()." added successfully ! \n";
        } catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }
    }

    public function showAllBooks():void{
        try{
            $sql = "SELECT * FROM books";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e){
            echo "Error: ".$e->getMessage()."\n";
        }
        foreach($books as $book){
            echo "-------------------------- \n";
            echo "id: ".$book['id']."\n";
            echo "isbn: ".$book['isbn']."\n";
            echo "title: ".$book['title']."\n";
            echo "author: " .$book['author']."\n";
            echo "state: " .$book['state']."\n";
            echo "-------------------------- \n";
        }
    }
    public function borrowBook(Member $member,Book $book):void{

    }
    public function returnBook(Member $Member,Book $Book):void{

    }
}