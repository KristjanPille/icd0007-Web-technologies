<?php

require 'vendor/tpl.php';
require_once "mysqlitemlist.php";
require_once "item.php";

$loggedIn = FALSE;
$language = language();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $loggedIn = TRUE;
}

$cmd = "login_page";
if (isset($_GET["cmd"])) {
    $cmd = $_GET["cmd"];
}

if ($cmd === "login_page") {
    include 'login.php';
}

if ($cmd === "log_out") {
    header( "Location: /?cmd=login_page" );
    $_SESSION = array();
    session_destroy();
    exit;
}

if ($cmd === "list_page" && $loggedIn === true) {
    $contacts = getContacts();
    $data = ['contacts' => $contacts, 'language' => $language];
    print renderTemplate("tpl/listpage.html", $data);
}

if ($cmd === "add_page" && $loggedIn === true) {
    $contacts = getContacts();
    $data = ['contacts' => $contacts, 'language' => $language];
    print renderTemplate("tpl/addpage.html", $data);
}

function printClientError($errors) {
    http_response_code(400);
    $response = ["errors" => $errors];
    foreach($response as $result) {
        echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}


if($cmd === "save" && $loggedIn === true){
    $name = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $phone1 = "";
    $phone2 = "";
    $phone3 = "";
    $data = $data = ['language' => $language];

    if(isset($_POST['id']) and $_POST['id'] >= 1){
        $contact = getContactById($_POST['id']);
        updateContact($contact);
        $contacts = getContacts();
        $data = ['contacts' => $contacts, 'language' => $language];
        $_SESSION['data'] = $data;
        print renderTemplate("tpl/listpage.html", $data);
    }
    else {
        $item = new Item($name, $lastname, $phone1, $phone2, $phone3);
        $errors = $item->validate();
        if (empty($errors)) {
            addContact($item);

            $contacts = getContacts();
            $data = ['contacts' => $contacts];
            $_SESSION['data'] = $data;
            header( "Location: /?cmd=list_page" );
        } else {
            $message = $errors;
            $phone1 = $_POST['phone1'];
            $phone2 = $_POST['phone2'];
            $phone3 = $_POST['phone3'];
            $_SESSION['data'] = $data;
            $contact = new Item($name, $lastname, $phone1, $phone2, $phone3);
            $data = ['contact' => $contact, 'language' => $language, 'message' => $message];
            print renderTemplate("tpl/addpage.html", $data);
        }
    }

}

if($cmd === "edit_page" && $loggedIn === true){
    $id = $_GET['id'];
    $contact = getContactById($id);
    $data = ['contact' => $contact, 'language' => $language];
    print renderTemplate("tpl/addpage.html", $data);
}
