<?php
require_once("vendor/tpl.php");
require_once("contactList.php");

$cmd = "list_page";
if (isset($_GET["cmd"])) {
    $cmd = $_GET["cmd"];
}

if ($cmd === "list_page") {
    $contactItems = getContactItems();
    $data = ['todoItems' => $contactItems];
    print renderTemplate("listpage.html", $data);
}

if ($cmd === "add_page") {
    print renderTemplate("addpage.html");
}


if($cmd === "add"){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phone = $_POST['phone'];
    $item = new contactItem($firstName, $lastName, $phone);
    addContact($item);

    $contactItems = getContactItems();
    $data = ["contactItems" => $contactItems];
    print renderTemplate("listpage.html", $data);
}