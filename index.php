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
    print renderTemplate("hw2kodu/addpage.html");
}


if($cmd === "add"){
    $name = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $phone1 = "";
    $phone2 = "";
    $phone3 = "";

    if(strlen($name) >= 2){
        if(strlen($lastname) >= 2) {
            $item = new Item($name, $lastname, $phone1, $phone2, $phone3);
            addContact($item);

            $contacts = getContacts();
            $data = ['contacts' => $contacts];
            header("Location: ?cmd=list_page");
        }
    }
    else{
        header("Location: ?cmd=add_page");
    }
}