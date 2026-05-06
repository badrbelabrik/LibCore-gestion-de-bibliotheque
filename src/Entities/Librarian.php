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

        $isbn = readline("Enter the ISBN: \n");
        $title = readline("Enter the title of the book: \n");
        $author = readline("Enter the author name: \n");

        $newBook = new Book($isbn,$title,$author);
        $library->addBook($newBook);

        echo "The book ".$newBook->getTitle()."added successfully !";
    }

    public function addMember(Library $library):void{
        echo "\n--- ADD NEW MEMBER ---\n";
        echo "Enter the member name: ";
        $name = trim(fgets(STDIN));
        echo "Enter the email :";
        $email = trim(fgets(STDIN));
        echo "Enter the member type (student or professor): ";
        $type = trim(fgets(STDIN));

        $newMember = new Member($name,$email,$type);
        $library->registerMember($newMember);
    }
}