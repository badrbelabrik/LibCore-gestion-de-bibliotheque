<?php
require_once "src/Services/Connection.php";
require_once "src/Services/Library.php";

use Services\Connections;
use Services\Library;

$db=Connection::getConnection();

$library=new Library($db);

while (true){

    echo "\n===== MENU MEMBER =====\n";
    echo "1. Search Book\n";
    echo "2. Borrow Book\n";
    echo "3. Return Book\n";
    echo "4. My Borrowed Books\n";
    echo "5. Exit\n";

    $choice = readline("Choose option : ");

    switch ($choice){
        case 1:
            $title=readline("Entrer book title:");
            $book=$library->searchBook($title);
            if(empty($books)){
                echo  "No books found\n";
            }else{
                foreach ($books as $book){

                    echo "ID : " . $book['id'] . "\n";
                    echo "Title : " . $book['title'] . "\n";
                    echo "Author : " . $book['author'] . "\n";
                    echo "State : " . $book['state'] . "\n";
                    echo "----------------------\n";
                }

            }
            break;
            case 2:
            $memberId=readline("Entrer your member ID:");
            $bookId=readline("Enter book ID:");
            $library->borrowBook($memberId,$bookId);
            break;


            case 3:
            $memberId=readline("Entrer your member ID:");
            $bookId=readline("Enter book ID:");
            $library->returnBook($memberId,$bookId);
            break;
        case 4:

            $memberId = readline("Enter your member ID : ");

            $books = $library->getBorrowedBooks($memberId);

            if(empty($books)){
                echo "No borrowed books\n";
            }else{

                foreach ($books as $book){

                    echo "Title : " . $book['title'] . "\n";
                    echo "Author : " . $book['author'] . "\n";
                    echo "Return date : " . $book['date_return'] . "\n";
                    echo "----------------------\n";
                }
            }

            break;

        case 5:

            echo "Goodbye 👋\n";
            exit;

        default:

            echo "Invalid choice\n";
    }


}
