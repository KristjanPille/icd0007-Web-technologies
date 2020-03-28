<?php
require_once("item.php");
require_once("mysqlitemlist.php");
const DATA_FILE = "data.txt";


function addContact($item) {
    $serializeditem = "$item->name;$item->lastName;$item->phone";
    file_put_contents(DATA_FILE, $serializeditem . PHP_EOL, FILE_APPEND);
}

function getContacts() {
    $lines = file(DATA_FILE, FILE_IGNORE_NEW_LINES);
    $contacts = [];
    foreach ($lines as $line)
    {
        list($name, $lastName, $phone) = explode(";", urldecode($line));
        $contact = new Item($name, $lastName, $phone);
        $contacts[] = $contact;
    }

    return $contacts;
}