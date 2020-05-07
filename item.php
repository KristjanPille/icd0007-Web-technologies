<?php

class item
{
    public $name;
    public $lastName;
    public $phone1;
    public $phone2;
    public $phone3;
    public $id;

    public function __construct($name, $lastName, $phone1, $phone2, $phone3, $id=null) {
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

    public function validate() {
        $errors = [];

        if (!isset($this->name)) {
            $errors[] = "Name is needed ";
        }

        if (!isset($this->lastName)) {
            $errors[] = "lastname needed ";
        }
        if (strlen($this->name) < 2) {
            $errors[] = "first name length is less than 2 ";
        }
        if (strlen($this->lastName) < 2) {
            $errors[] = "Last name length is less than 2 ";
        }
        return implode(',', $errors);
    }
}