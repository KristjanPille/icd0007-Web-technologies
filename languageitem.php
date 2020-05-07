<?php

class languageitem
{
    public $surname;
    public $lastname;
    public $phones;
    public $list;
    public $add;
    public $signout;
    public $estonia;
    public $english;

    public function __construct($surname, $lastname, $phones, $list, $add, $signout, $estonia, $english) {
        $this->surname = $surname;
        $this->lastname = $lastname;
        $this->phones = $phones;
        $this->list = $list;
        $this->add = $add;
        $this->signout = $signout;
        $this->estonia = $estonia;
        $this->english = $english;
    }

    public function __toString() {
        return "$this->surname, $this->lastname, $this->phones, $this->list, $this->add, $this->signout, $this->estonia, $this->english";
    }
}