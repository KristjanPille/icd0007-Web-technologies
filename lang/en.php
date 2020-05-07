<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//english lang
$_SESSION['surname'] = "First name";
$_SESSION['lastname'] = "Last name";
$_SESSION['phones'] = "Phones";
$_SESSION['list'] = "List of contacts";
$_SESSION['surname'] = "First name";
$_SESSION['add'] = "Add contact";
$_SESSION['estonia'] = "Estonian";
$_SESSION['english'] = "English";
$_SESSION['signout'] = "Logout";
$signout = "Sign Out of Your Account";
$login = "Login";
$surname = "First name";
$lastname = "Last name";
$phones = "Phones";
$save = "Save";
$list = "List of contacts";
$add = "Add contact";
$cedentials = "Please fill in your credentials to login.";
$username = "Username";
$password = "Password";
$en = "English";
$et = "Estonian";