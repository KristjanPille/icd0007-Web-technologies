<?php

if(isset($_GET["language"])) {
    $lang = $_GET["language"];
    if ($lang == "en") {
        $_COOKIE["language"] = $lang;
    }
    if ($lang == "et") {
        $_COOKIE["language"] = $lang;
    }
    setcookie('language', $_COOKIE['language']);
}

if(isset($_COOKIE["language"])) {
    if ($_COOKIE["language"] == "en") {
        include('lang/en.php');
    } else if ($_COOKIE["language"] == "et") {
        include('lang/et.php');
    }
}
if(!isset($_COOKIE["language"])){
    include('lang/en.php');
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<div id="wrapper">
    <ul>
        <a id="lang-et-link" href="?cmd=<?= $cmd ?>&language=et" class="btn btn-info" role="button"><?php echo $et;?></a>
        <a id="lang-en-link" href="?cmd=<?= $cmd ?>&language=en" class="btn btn-info" role="button"><?php echo $en;?></a>
    </ul>
</div>
</body>
</html>