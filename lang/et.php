<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//english lang
$_SESSION['signout'] = "Logi välja";
$_SESSION['login'] = "Logi sisse";

$_SESSION['surname'] = "Eesnimi";
$_SESSION['lastname'] = "Perekonna nimi";
$_SESSION['phones'] = "Telefonid";
$_SESSION['list'] = "Kontaktid";
$_SESSION['surname'] = "Eesnimi";
$_SESSION['add'] = "Lisa kontakt";
$_SESSION['estonia'] = "Eesti";
$_SESSION['english'] = "Inglise";
$signout = "Logi välja";
$login = "Logi sisse";
$surname = "Eesnimi";
$lastname = "Perekonna nimi";
$phones = "Telefonid";
$save = "Salvesta";
$list = "Kontaktid";
$add = "Lisa kontakt";
$cedentials = "Palun täitke vorm, et sisse logida";
$username = "Kasutajanimi";
$password = "Salasõna";
$en = "Inglise";
$et = "Eesti";