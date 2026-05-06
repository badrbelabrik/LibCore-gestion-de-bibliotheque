<?php
use Services\Connection;
use Services\Library;
require "src/Services/Connection.php";
require "src/Services/Library.php";

$con = Connection::getConnection();
$lib = new Library("myLibrary",$con);
echo "------ LIST OF BOOKS ------ \n";
$lib->showAllBooks();