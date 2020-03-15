<?php
require ('vendor/tpl.php');
require_once ('contactItem.php');
require_once ('ContactList.php');

$cmd = "list_page";
if (isset($_GET["cmd"])) {
    $cmd = $_GET["cmd"];
}

if ($cmd === "list_page") {
    $contactItems = getContactItems();
    $data = ['contactItems' => $contactItems];
    print renderTemplate("listpage.html", $data);
}

if ($cmd === "add_page") {
    print renderTemplate("addpage.html");
}

if($cmd === "add"){
    $firstName = urlencode($_POST['firstName']);
    $lastName = urlencode($_POST['lastName']);
    $phone = urlencode($_POST['phone']);
    $item = new contactItem($firstName, $lastName, $phone);
    addContact($item);

    $contactItems = getContactItems();
    $data = ["contactItems" => $contactItems];
    print renderTemplate("listpage.html", $data);
}