<?php

namespace Entities;
use Entities\Book;
use Entities\Member;
use Entities\Connection;
use PDO;

class Library
{
    private PDO $db;
    private string $name;
    private Connection $con;

    public function __construct(string $name ,Connection $con){
        $this->name = $name;
        $this->con=$con;
    }
    public function addBook(Book $book):void{
        $this->books[] = $book;

    }
    public function registerMember(Member $member):void{
        $this->users[] = $member;

    }
    public function borrowBook(int $memberId, int $bookId): void {

        $stmt = $this->db->prepare("SELECT isAvailable FROM books WHERE id = ?");
        $stmt->execute([$bookId]);
        $book = $stmt->fetch();

        if (!$book || !$book['isAvailable']) {
            echo "Livre non disponible\n";
            return;
        }

        $stmt = $this->db->prepare(
            "UPDATE books SET isAvailable = 0, state = 'emprunté' WHERE id = ?"
        );
        $stmt->execute([$bookId]);

        $stmt = $this->db->prepare(
            "INSERT INTO borrows (member_id, book_id) VALUES (?, ?)"
        );
        $stmt->execute([$memberId, $bookId]);

        echo "Livre emprunté avec succès\n";
    }
    public function returnBook(int $memberId, int $bookId): void {

        $stmt = $this->db->prepare(
            "UPDATE books SET isAvailable = 1, state = 'disponible' WHERE id = ?"
        );
        $stmt->execute([$bookId]);

        $stmt = $this->db->prepare(
            "DELETE FROM borrows WHERE member_id = ? AND book_id = ?"
        );
        $stmt->execute([$memberId, $bookId]);

        echo "Livre rendu avec succès\n";
    }
    public function searchBook(string $keyword): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM books WHERE title LIKE ? OR author LIKE ?"
        );

        $stmt->execute(["%$keyword%", "%$keyword%"]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBorrowedBooks(int $memberId): array {

        $stmt = $this->db->prepare(
            "SELECT b.title 
             FROM books b
             JOIN borrows br ON b.id = br.book_id
             WHERE br.member_id = ?"
        );

        $stmt->execute([$memberId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




}