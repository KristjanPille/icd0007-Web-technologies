<?php

require_once 'Person.php';

function statementToPersonList($stmt) {

    $dictionary = [];
    $personList = [];

    foreach ($stmt as $row) {
        $id = $row['id'];
        $name = $row['name'];
        $number = $row['number'];
        // kood tuleb siia

        $person = new Person($id, $name);
        if(isset($personList[$name])){
            $person->addPhone($number);
        }
        else if (!isset($personList[$name])){
            $personList[] = $person;
            $person->addPhone($number);
        }
    }

    var_dump($personList);
    return $personList;
}
