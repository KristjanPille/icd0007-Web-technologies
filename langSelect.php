<?php

if(isset($_GET["language"])) {
    $lang = $_GET["language"];
    if ($lang == "en") {
        $_COOKIE["language"] = $lang;
    }
    if ($lang == "et") {
        $_COOKIE["language"] = $lang;
    }
    setcookie('language', $_COOKIE['language'], time()+86400, '/');
}

if(isset($_COOKIE["language"])) {
    if ($_COOKIE["language"] == "en") {
        include('lang/en.php');
    } else if ($_COOKIE["language"] == "et") {
        include('lang/et.php');
    }
}
if(!isset($_COOKIE["language"])){
    include('lang/et.php');
}

if (isset($_GET["language"])) {
    $cmd = $_GET["language"];
}
if (isset($_GET["cmd"])) {
    $cmd = $_GET["cmd"];
}

else {
    $cmd = "login_page";
}
