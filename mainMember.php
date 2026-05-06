<?php
require_once  "Entities/Book.php";
require_once  "Entities/User.php";
require_once  "Entities/Member.php";
require_once  "Entities/Library.php";

use Entities\Book;
use Entities\Member;
use Entities\Library;

$library=new Library("Ma Bibliothèque");

$b1=new Book("111","Clesn Code", "Robert Martin");
$b2=new Book("222","Design Patterns", "Gof");

$library->addBook($b1);
$library->addBook($b2);