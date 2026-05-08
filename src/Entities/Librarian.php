<?php

namespace Entities;

use Services\Library;
use Entities\Book;

class Librarian extends User
{
    public function __construct(string $name,string $email){
        parent::__construct($name,$email);
    }

    public function addBook(Library $library):void{
        echo "\n--- ADD NEW BOOK ---\n";
        echo "Enter the ISBN: ";
        $isbn = trim(fgets(STDIN));
        echo "Enter the title of the book: ";
        $title = trim(fgets(STDIN));
        echo "Enter the author name: ";
        $author = trim(fgets(STDIN));

        $newBook = new Book($isbn,$title,$author);
        $library->addBook($newBook);
    }

    public function deleteBook(Library $library){
        echo "\n--- Delete BOOK ---\n";
        echo "Enter the book id: ";
        $id = trim(fgets(STDIN));
        $library->deleteBook($id);
    }
    public function addMember(Library $library):void{
        echo "\n--- ADD NEW MEMBER ---\n";
        echo "Enter the member name: ";
        $name = trim(fgets(STDIN));
        echo "Enter the email :";
        $email = trim(fgets(STDIN));
        $memberType = null;
        do{
            echo "Member role (1 for student) or (2 for professor): ";
            $type = trim(fgets(STDIN));
            if($type == 1){
                $memberType = 'student';
            }elseif($type == 2){
                $memberType = 'professor';
            }
        } while ($type != 1 && $type != 2);


        $newMember = new Member($name,$email,$memberType);
        $library->registerMember($newMember);
    }
}