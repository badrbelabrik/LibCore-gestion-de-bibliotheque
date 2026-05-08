<?php
require "src/Services/Connection.php";
require "src/Services/Library.php";

use Services\Connection;
use Services\Library;

$db=Connection::getConnection();

$library=new Library($db);
$stmt = $db->query("SELECT * FROM members");

$members = $stmt->fetchAll(PDO::FETCH_ASSOC);

//print_r($members);
echo "----- Library login system -----\n";
echo "Enter votre nom: ";
$name = trim(fgets(STDIN));
echo "Enter votre email: ";
$email = trim(fgets(STDIN));
$member=$library->loginMember($name,$email);
if($member===false){
    echo "Invalid credentials \n";
    exit();
}
echo "\n Welcome " . $member['name'] . "\n";
$memberId=$member['id'];




do {

    echo "\n===== MENU MEMBER =====\n";
    echo "1. Search Book\n";
    echo "2. Borrow Book\n";
    echo "3. Return Book\n";
    echo "4. My Borrowed Books\n";
    echo "5. Exit\n";

    echo "Choose option :";
    $choice = trim(fgets(STDIN));
    switch ($choice) {

        case 1:

            echo "Entrer book title: ";
            $title = trim(fgets(STDIN));
            $book = $library->searchBook($title);
            if (empty($book)) {
                echo "No books found\n";
            } else {
                foreach ($book as $b) {

                    echo "ID : " . $b['id'] . "\n";
                    echo "Title : " . $b['title'] . "\n";
                    echo "Author : " . $b['author'] . "\n";
                    echo "State : " . $b['state'] . "\n";
                    echo "----------------------\n";
                }

            }
            break;
        case 2:
            echo "Enter book ID: ";
            $bookId = trim(fgets(STDIN));

            $library->borrowBook($memberId, $bookId);
            break;


        case 3:
            echo "Enter book ID: ";
            $bookId = trim(fgets(STDIN));

            $library->returnBook($memberId, $bookId);
            break;
        case 4:


            $books = $library->getBorrowedBooks($memberId);

            if (empty($books)) {
                echo "No borrowed books\n";
            } else {

                foreach ($books as $book) {

                    echo "Title : " . $book['title'] . "\n";
                    echo "Author : " . $book['author'] . "\n";
                    echo "Return date : " . $book['date_return'] . "\n";
                    echo "----------------------\n";
                }
            }

            break;

        case 5:

            echo "Goodbye \n";
            exit;

        default:

            echo "Invalid choice\n";
    }



} while ($choice!=0) ;
