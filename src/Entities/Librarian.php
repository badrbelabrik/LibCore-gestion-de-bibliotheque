<?php

namespace Entities;

class Librarian
{
    public function __construct(){

    }

    public function registerMember(Library $library,Member $member):void{

    }
    public function addBook(Library $library):void{
        echo "\n--- ADD NEW BOOK ---\n";
        $isbn = trim(readline("Enter the ISBN: "));
        $title = trim(readline("Enter the title of the book: "));
        $author = trim(readline("Enter the author name: "));

        $newBook = new Book($isbn,$title,$author);
        $library->addBook($newBook);

        echo "The book ".$newBook->getTitle()."added successfully !";
    }

    public function addMember(Library $library):void{
        echo "\n--- ADD NEW MEMBER ---\n";
        $name = trim(readline("Enter the member name :"));
        $email = trim(readline("Enter the email :"));
        $type = trim(readline("Enter the member type (student or professor): "));

        $newMember = new Member($name,$email,$type);
        $library->registerMember($newMember);
    }
}