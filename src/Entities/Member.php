<?php

namespace Entities;

class Member extends User
{
    private string $type;
    private array $borrowedBooks=[];

    public function __construct(string $name,string $email,string $type){
        parent::__construct($name,$email);
        $this->type = $type;
    }
    public function borrowBook(Book $book):void{
        if($book->isAvailable()){
            $this->borrowedBooks[]=$book;
            $book->setIsAvailable(false);
            $book->setState("emprunté");
            echo "Livre emprunté avec succés\n";

        }else{
            echo "Livre non disponible\n";
        }


    }
    public function returnBook(Book $book):void{
        foreach($this->borrowedBooks as $key=>$b){
            if($b === $book){
                unset($this->borrowedBooks[$key]);
                $book->setIsAvailable(true);
                $book->setState("disponible");
                echo "Livre rendu avec succès\n";
                return;
            }
        }
        echo  "ce Livre ne plus appartient pas\n";
    }
    public  function showBorrowedBooks():void{
        echo "Mes Livres\n";
        foreach ($this->borrowedBooks as $book){
            echo "_" . $book->getTitle() . "\n";
        }
    }



}