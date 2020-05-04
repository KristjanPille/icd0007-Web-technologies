<?php
require_once("item.php");
const DATA_FILE = "data.txt";

const USERNAME = "krpill";
const PASSWORD = "0f23";
const URL = "mysql:host=db.mkalmo.xyz;dbname=krpill";
const DB = "krpill";

$link = mysqli_connect("db.mkalmo.xyz", USERNAME, PASSWORD, DB);

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

        $stmt->bindValue('contact_id', $idValue);
        $stmt->bindValue('number', $phone);

        $stmt->execute();
    }
}

function getContacts() {
    $connection = new PDO(URL, USERNAME, PASSWORD);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $statement = $connection->prepare("SELECT krpill.contacts.id, krpill.contacts.name, krpill.contacts.lastname,
 GROUP_CONCAT(krpill.phones.number SEPARATOR ', ')
FROM contacts
         LEFT JOIN phones
                    ON contacts.id = phones.contact_id
GROUP BY contacts.id;");

    $statement->execute();

    $contactsList = [];


    foreach ( $statement as $row) {
        $id = $row["id"];
        $name = $row["name"];
        $lastname = $row["lastname"];
        $phone2 = "";
        $phone3 = "";

        $value = $row[3];
        $values = explode(",", $value);

        $phone1 = $values[0];
        if(isset($values[1])) {
            $phone2 = $values[1];
        }
        if(isset($values[2])) {
            $phone3 = $values[2];
        }

        $contacts = new item($name, $lastname, $phone1, $phone2, $phone3, $id);

        $contactsList[$id] = $contacts;
    }
    return array_values($contactsList);
}


function getContactById($id) {
    $connection = new PDO(URL, USERNAME, PASSWORD);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $statement = $connection->prepare("SELECT krpill.contacts.id, krpill.contacts.name, krpill.contacts.lastname,
 GROUP_CONCAT(krpill.phones.number SEPARATOR ', ')
FROM contacts
         LEFT JOIN phones
                    ON contacts.id = phones.contact_id
WHERE krpill.contacts.id = :id
GROUP BY contacts.id");
    $statement->bindValue(":id", $id);
    $statement->execute();

    $contact = null;

    foreach ( $statement as $row) {
        $id = $row["id"];
        $name = $row["name"];
        $lastname = $row["lastname"];
        $phone2 = "";
        $phone3 = "";

        $value = $row[3];
        $values = explode(", ", $value);

        $phone1 = $values[0];
        if(isset($values[1])) {
            $phone2 = $values[1];
        }
        if(isset($values[2])) {
            $phone3 = $values[2];
        }

        $contact = new item($name, $lastname, $phone1, $phone2, $phone3, $id);
    }
    return $contact;
}

function updateContact($contact) {
    $connection = new PDO(URL, USERNAME, PASSWORD);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $statement = $connection->prepare("update krpill.contacts
      set 
      name = :name, 
      lastname = :lastName
    
      where contacts.id = :id");
    $statement->bindValue("name", $_POST['firstName']);
    $statement->bindValue("lastName", $_POST['lastName']);
    $statement->bindValue("id", $contact->id);

    $statement->execute();

    $delete = $connection->prepare("DELETE FROM krpill.phones WHERE contact_id = :id");
    $delete->bindValue("id",  $contact->id);

    $delete->execute();

    $phones = array($_POST['phone1']);

    if (!empty($_POST['phone2'])) {
        array_push($phones, $_POST['phone2']);
    }

    if (!empty($_POST['phone3'])) {
        array_push($phones, $_POST['phone3']);
    }
    foreach ($phones as $phone) {
        echo $phone;
        $insert = "INSERT INTO krpill.phones (contact_id, number) VALUES (:contact_id, :number);";
        $stmt = $connection->prepare($insert);
        $stmt->bindValue('contact_id', $contact->id);
        $stmt->bindValue('number', $phone);

        $stmt->execute();
    }


    return getContactById($contact->id);
}
