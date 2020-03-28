<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="hw2kodu/hw2_css.css">
    <title>Osa 2</title>
</head>

<body>

<div>
    <div id="menu"><a href="?cmd=list_page" id="list-page-link">Nimekiri</a>&nbsp;&nbsp;|&nbsp;
        <a href="?cmd=add_page" id="add-page-link">Lisa</a></div>
</div>


<div id="error-block" class="leftsidebox">
    <?php
    if (isset($message)) {
        echo $message;
    }
    if (isset($message1)) {
        echo $message1;
    }
    ?>
</div>
<form method="post" action="?cmd=save">

    <table class="form-table">
        <tbody>
        <tr>
            <td>Eesnimi:</td>
            <td><input name="firstName" value="<?php
                echo isset($_POST["firstName"]) ? $_POST["firstName"] : '';
                ?>"></td>
        </tr>
        <tr>
            <td>Perekonnanimi:</td>
            <td><input name="lastName" value="<?php
                echo isset($_POST["lastName"]) ? $_POST["lastName"] : '';
                ?>"></td>
        </tr>
        <tr>
            <td>Telefon 1:</td>
            <td><input name="phone1" value="<?php
                echo isset($_POST["phone1"]) ? $_POST["phone1"] : '';
                ?>"></td>
        </tr>
        <tr>
            <td>Telefon 2:</td>
            <td><input name="phone2" value="<?php
                echo isset($_POST["phone2"]) ? $_POST["phone2"] : '';
                ?>"></td>
        </tr>
        <tr>
            <td>Telefon 3:</td>
            <td><input name="phone3" value="<?php
                echo isset($_POST["phone3"]) ? $_POST["phone3"] : '';
                ?>"></td>
        </tr>
        <tr>
            <td colspan="2"><br>
                <input name="submitButton" type="submit" value="Salvesta">
            </td>
        </tr>

        </tbody>
    </table>

</form>


</body>
</html>