<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <title>Osa 2</title>
</head>
<body>
<?php include 'langSelect.php' ?>
<div>
    <div id="menu">
        <a id="list-page-link" href="?cmd=list_page" class="btn btn-info" role="button"><?php echo $list;?></a>
        <a id="add-page-link" href="?cmd=add_page" class="btn btn-info" role="button"><?php echo $add;?></a>
    </div>
</div>
<form method="post" action="?cmd=save">
    <div id="error-block" class="leftsidebox">
        <?php
        if (isset($message)) {
            echo implode(" ",$message);
        }
        ?>
    </div>
    <table class="form-table">
        <tbody>
        <tr>
            <td><input type="hidden" name="id" value="<?php
                echo isset($_POST["id"]) ? $_POST["id"] : '';
                ?>"></td>
        </tr>
        <tr>
            <td><?php echo $surname;?>:</td>
            <td><input name="firstName" value="<?php
                echo isset($_POST["firstName"]) ? $_POST["firstName"] : '';
                ?>"></td>
        </tr>
        <tr>
            <td><?php echo $lastname;?>:</td>
            <td><input name="lastName" value="<?php
                echo isset($_POST["lastName"]) ? $_POST["lastName"] : '';
                ?>"></td>
        </tr>
        <tr>
            <td><?php echo $phones;?>:</td>
            <td><input name="phone1" value="<?php
                echo isset($_POST["phone1"]) ? $_POST["phone1"] : '';
                ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><input name="phone2" value="<?php
                echo isset($_POST["phone2"]) ? $_POST["phone2"] : '';
                ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><input name="phone3" value="<?php
                echo isset($_POST["phone3"]) ? $_POST["phone3"] : '';
                ?>"></td>
        </tr>
        <tr>
            <td colspan="2"><br>
                <button name="submitButton" class="btn btn-primary" type="submit"><?php echo $save;?></button>
            </td>
        </tr>

        </tbody>
    </table>

</form>
<a href="logout.php" id="log-out-link"><?php echo $signout;?></a>

</body>
</html>