<?php

namespace Entities;

class Member extends User
{

    private string $type;

    public function __construct(string $name,string $email,string $type){
        parent::__construct($name,$email);
        $this->type = $type;
    }
    public  function getType():string{
        return  $this->type;
    }
    public  function setType(string $type):void{
        $this->type=$type;
    }









}