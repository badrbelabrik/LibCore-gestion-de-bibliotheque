<?php

namespace Services;

use Entities\Book;
use Entities\Member;
use PDO;
use PDOException;

class Library
{
    private string $name;
    private PDO $db;

    public function __construct(string $name,PDO $con){
        $this->db = $con;
        $this->name = $name;
    }
    public function addBook(Book $book):void{
        try{
            $sql = "INSERT INTO books (isbn, title, author) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$book->getIsbn(), $book->getTitle(), $book->getAuthor()]);

            echo "Book ".$book->getTitle()." added successfully ! \n";
        } catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }
    }

    public function deleteBook($id):void{
        try{
            $sql = "SELECT * FROM books WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);
            $book = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!$book){
                echo "Book not found !";
                return;
            }
            if($book['state'] != "Deleted" && $book['isAvailable'] == true){
                $delSql = "UPDATE books SET isAvailable = false,state = 'Deleted' WHERE id = ?";
                $stmt = $this->db->prepare($delSql);
                $stmt->execute([$id]);
                echo"Book deleted successfully ! \n";
            } else{
                echo "You cannot delete this book";
            }

        } catch(PDOException $e){
            echo "Error :".$e->getMessage();
        }
    }

    public function markBookUnderRepair($id){
        try{
            $sql = "SELECT * FROM books WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);
            $book = $stmt->fetch(PDO::FETCH_ASSOC);
            if($book['state'] == 'En réparation'){
                echo "The book is already under repair\n";
            } else if($book['isAvailable'] == true && $book['state'] == 'Disponible'){
                $repairSql = "UPDATE books SET isAvailable = false, state='En réparation' WHERE id = ?";
                $stmt = $this->db->prepare($repairSql);
                $stmt->execute([$id]);
                echo "The book marked under repair !\n";
            } else{
                echo "you cant mark this book under repair \n";
            }
        }catch(PDOException $e){
            echo "Error :".$e->getMessage();
        }
    }
    public function registerMember(Member $member):void{
        try{
            $sql = "INSERT INTO members (name,email,member_type) VALUES (?, ?, ?)";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([$member->getName(),$member->getEmail(),$member->getType()]);

            echo "Member ".$member->getName()." added successfully ! \n";
        } catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }
    }

    public function showAllBooks():void{
        try{
            $sql = "SELECT * FROM books WHERE state != 'Deleted'";
            $stmt = $this->db->prepare($sql);
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