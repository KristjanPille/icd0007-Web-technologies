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

function printClientError($errors) {
    http_response_code(400);
    $response = ["errors" => $errors];
    foreach($response as $result) {
        echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}


if($cmd === "save"){
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $phone1 = "";
    $phone2 = "";
    $phone3 = "";

    if(isset($_POST['id']) and $_POST['id'] >= 1){
        $contact = getContactById($_POST['id']);
        updateContact($contact);
        $contacts = getContacts();
        $data = ['contacts' => $contacts];
        print renderTemplate("hw2kodu/listpage.html", $data);
    }
    else {
        $item = new Item($firstname, $lastname, $phone1, $phone2, $phone3);
        $errors = $item->validate();
        if (empty($errors)) {
            addContact($item);

            $contacts = getContacts();
            $data = ['contacts' => $contacts];
            header( "Location: /?cmd=list_page" );
        } else {
            $message = $errors;

            $phone1 = $_POST['phone1'];
            $phone2 = $_POST['phone2'];
            $phone3 = $_POST['phone3'];

            include 'addpage.php';
        }
    }

}

if($cmd === "edit_page"){
    $id = $_GET['id'];

    $contact = getContactById($id);
    $_POST['firstName'] = $contact->name;
    $_POST['lastName'] = $contact->lastName;
    $_POST['phone1'] = $contact->phone1;
    $_POST['phone2'] = $contact->phone2;
    $_POST['phone3'] = $contact->phone3;
    $_POST['id'] = $contact->id;
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $phone1 = $_POST['phone1'];
    $phone2 = $_POST['phone2'];
    $phone3 = $_POST['phone3'];
    $id = $_POST['id'];

    include 'addpage.php';
}