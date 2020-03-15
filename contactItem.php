<?php

class contactItem{
    public $firstName;
    public $lastName;
    public $phone;

    public function __construct($firstName, $lastName, $phone)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
    }
    public function __toString() {
        return "item{id: $this->firstName, name: $this->lastName, lastName: $this->phone}";
    }
}
