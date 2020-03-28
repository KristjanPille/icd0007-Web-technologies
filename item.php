<?php

class item
{
    public $id;
    public $name;
    public $lastName;
    public $phone1;
    public $phone2;
    public $phone3;

    public function __construct($name, $lastName, $phone1, $phone2, $phone3, $id = null) {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->phone1 = $phone1;
        $this->phone2 = $phone2;
        $this->phone3 = $phone3;
        $this->id = $id;
    }

    public function __toString() {
        return "item{id: $this->id, name: $this->name, lastName: $this->lastName, 
        phone1: $this->phone1, phone2: $this->phone2, phone3: $this->phone3}";
    }
}