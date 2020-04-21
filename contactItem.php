<?php

class contactItem{
    public $firstName;
    public $lastName;
    public $phone;
    public $id;

    public function __construct($firstName, $lastName, $phone, $id = null) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
        $this->id = $id;
    }
    public function __toString() {
        return "item{id: $this->id, firstname: $this->firstName, lastName: $this->lastName, phone: $this->phone}";
    }
}
