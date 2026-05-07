<?php

use Services\Connection;
use Services\Library;
use Entities\Book;
use Entities\Member;
use Entities\Librarian;
require "src/Entities/User.php";
require "src/Entities/Librarian.php";
require "src/Entities/Member.php";
require "src/Entities/Book.php";
require "src/Services/Connection.php";
require "src/Services/Library.php";

$con = Connection::getConnection();
$lib = new Library("myLibrary",$con);
$librarian1 = new Librarian("badr","badr.belabrik@gmail.com");



do{
    echo "------ ADMIN MENU ------ \n";
    echo "1)- Add member \n";
    echo "2)- Add book \n";
    echo "3)- Show all books \n";
    echo "0 - Exit \n";
    echo "Your choice: ";
    $choix = (int)readline("Enter your choice: \n");
    switch($choix){
        case 1:
            $librarian1->addMember($lib);
            break;
        case 2:
            $librarian1->addBook($lib);
            break;
        case 3:
            $lib->showAllBooks();
            break;
        default:
            echo "incorrect choice \n";
    }
}while($choix !=0);
