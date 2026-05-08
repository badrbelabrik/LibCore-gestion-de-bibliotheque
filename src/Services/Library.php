<?php

namespace Services;
use Entities\Book;
use Entities\Member;
use Entities\Connection;
use PDO;

class Library
{
    private PDO $db;

    public function __construct(PDO $db){
        $this->db=$db;
    }
    public function searchBook(string $title):array{
        $stmt= $this->db->prepare(
            "SELECT * FROM books 
                WHERE title Like ?"
        );
        $stmt->execute(["%$title%"]);
    return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public  function borrowBook(int $memberId , int $bookID):void{
        $stmt=$this->db->prepare(
            "SELECT * FROM books WHERE id=?"
        );
        $stmt->execute([$bookID]);
        $book=$stmt->fetch((PDO::FETCH_ASSOC));

        if(!$book){
            echo "Lvre introuvable";
            return;
        }
        if(!$book['isAvailable']){
            echo "Livre non disponible\n";
            return;
        }

        $stmt=$this->db->prepare(
            "UPDATE books 
                SET isAvailable=FALSE,
                    state='emprunté'
                    WHERE id=?"
        );
        $stmt->execute([$bookID]);

        $stmt=$this->db->prepare(
            "INSERT INTO borrows(id_member,id_book,date_borrow,date_return)
                    VALUES(?,?,NOW(),DATE_ADD(NOW(), INTERVAL 7 DAY))"
        );
        $stmt->execute([
            $memberId,
            $bookID,
        ]);

        echo "Lvre emprunté avec siccès\n";

    }
    public function returnBook(int $memberId, int $bookId): void {

        $stmt = $this->db->prepare(
            "UPDATE borrows
                    SET returned = TRUE
                        WHERE id_member = ?
                        AND id_book=?"
        );
        $stmt->execute([
            $memberId,
            $bookId
        ]);

        $stmt = $this->db->prepare(
            "UPDATE books 
                    SET isAvailable=TRUE,
                        state='disponible'
                    WHERE id=?
                    "
        );
        $stmt->execute([ $bookId]);

        echo "Livre rendu avec succès\n";
    }




    public function getBorrowedBooks(int $memberId): array {

        $stmt = $this->db->prepare(
            "SELECT  b.id,b.title,b.author,br.date_return
             FROM books b
             JOIN borrows br ON b.id = br.id_book
             WHERE br.id_member = ?
             AND br.returned=FALSE"
        );

        $stmt->execute([$memberId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public  function loginMember(string $name, string $email){
        $stmt=$this->db->prepare(
            "SELECT * FROM members
                    WHERE name=? AND email=?"
        );
        $stmt->execute([$name,$email]);
return        $result=$stmt->fetch(PDO::FETCH_ASSOC);

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








    public function addBook(Book $book):void{
        $this->books[] = $book;

    }
    public function registerMember(Member $member):void{
        $this->users[] = $member;

    }







}