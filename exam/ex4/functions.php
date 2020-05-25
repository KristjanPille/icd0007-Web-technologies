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
        if(isset($personList[$person->id])){
            $person->addPhone($number);
            array_push($personList, $person);
        }
        else if (!isset($personList[$person->id])){
            $person->addPhone($number);
            array_push($personList, $person);
        }
    }

    var_dump($personList);
    return $personList;
}
