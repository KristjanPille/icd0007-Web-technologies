<?php
require_once("item.php");
const DATA_FILE = "data.txt";

const USERNAME = "krpill";
const PASSWORD = "0f23";
const URL = "mysql:host=db.mkalmo.xyz;dbname=krpill";

function addContact($item) {
    $connection = new PDO(URL, USERNAME, PASSWORD);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $insert = $connection->prepare('insert into krpill.contacts(name, lastname) 
                                                values (:name , :lastname)');

    $insert->bindValue(':name', $item->name);
    $insert->bindValue(':lastname', $item->lastName);

    $insert->execute();
    $idValue = $connection->lastInsertId();
    $phones = array($_POST['phone1']);

    if (!empty($_POST['phone2'])) {
        array_push($phones, $_POST['phone2']);
    }

    if (!empty($_POST['phone3'])) {
        array_push($phones, $_POST['phone3']);
    }

    foreach ($phones as $phone) {

        $insert = "INSERT INTO krpill.phones (contact_id, number) VALUES (:contact_id, :number);";
        $stmt = $connection->prepare($insert);

        $stmt->bindParam('contact_id', $idValue);
        $stmt->bindParam('number', $phone);

        $stmt->execute();
    }
}

function getContacts() {
    $connection = new PDO(URL, USERNAME, PASSWORD);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $statement = $connection->prepare("SELECT krpill.contacts.name, krpill.contacts.lastname,
 GROUP_CONCAT(krpill.phones.number SEPARATOR ', ')
FROM contacts
         LEFT JOIN phones
                    ON contacts.id = phones.contact_id
GROUP BY contacts.id;");

    $statement->execute();

    $contactsList = [];


    foreach ( $statement as $row) {
        $name = $row["name"];
        $lastname = $row["lastname"];


        $value = $row[2];
        $values = explode(",", $value);

        $phone1 = $values[0];
        if(isset($values[1])) {
            $phone2 = $values[1];
        }
        if(isset($values[2])) {
            $phone3 = $values[2];
        }

        $contacts = new item($name, $lastname, $phone1, $phone2, $phone3);

        $contactsList[] = $contacts;
    }
    return $contactsList;
}




$db = null;