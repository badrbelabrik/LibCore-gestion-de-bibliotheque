<?php
require "src/Services";
use Entities\Connection;
use Entities\Library;

$con = Connection::getConnection();
$lib = new Library("myLibrary",$con);