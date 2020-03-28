<?php

require 'vendor/tpl.php';
require_once "mysqlitemlist.php";
require_once "item.php";

$cmd = "list_page";
if (isset($_GET["cmd"])) {
    $cmd = $_GET["cmd"];
}

if ($cmd === "list_page") {

    $contacts = getContacts();
    $data = ['contacts' => $contacts];
    print renderTemplate("hw2kodu/listpage.html", $data);
}

if ($cmd === "add_page") {
    include 'addpage.php';
}


if($cmd === "save"){
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $phone1 = "";
    $phone2 = "";
    $phone3 = "";

    if(strlen($firstname) >= 2){
        if(strlen($lastname) >= 2) {
            $item = new Item($firstname, $lastname, $phone1, $phone2, $phone3);
            addContact($item);

            $contacts = getContacts();
            $data = ['contacts' => $contacts];
            print renderTemplate("hw2kodu/listpage.html", $data);
        }
    }
    else{
        $phone1 = $_POST['phone1'];
        $phone2 = $_POST['phone2'];
        $phone3 = $_POST['phone3'];
        if(strlen($firstname) < 2){
            $message = "Firstname must be atleast two letters long  ";
        }
        if(strlen($lastname) < 2){
            $message1 = " Lastname must be atleast two letters long";
        }
        include 'addpage.php';
    }
}