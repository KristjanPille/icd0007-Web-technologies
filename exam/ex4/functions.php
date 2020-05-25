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
    }

    return $personList;
}
