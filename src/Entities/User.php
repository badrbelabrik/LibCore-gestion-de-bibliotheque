<?php

namespace Entities;

class User
{
    private static int $nextId = 1;
    private int $id;
    private string $name;
    private string $email;

    public function __construct(string $name,string $email){
        $this->id = self::$nextId++;
        $this->name = $name;
        $this->email = $email;
    }
}