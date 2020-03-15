<?php
require_once('contactItem.php');

const DATA_FILE = "data.txt";

function addContact ($contactItem) {
    $serializeditem = "$contactItem->firstName**$contactItem->lastName**$contactItem->phone";
    file_put_contents(DATA_FILE, $serializeditem . PHP_EOL, FILE_APPEND);
}

function getContactItems () {
    $lines = file(DATA_FILE, FILE_IGNORE_NEW_LINES);
    $contactItems = [];
    foreach ($lines as $line){
        list($firstName, $lastName, $phone) = explode("**", $line);
        $contactItem = new contactItem($firstName, $lastName, $phone);
        $contactItems[] = $contactItem;
    }
    return $contactItems;
}
