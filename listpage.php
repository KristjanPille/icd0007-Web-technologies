<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <title>Osa 2</title>
</head>
<body>
<?php include 'langSelect.php';?>
<div>
    <div id="menu">
        <a id="list-page-link" href="?cmd=list_page" class="btn btn-info" role="button"><?php echo $list;?></a>
        <a id="add-page-link" href="?cmd=add_page" class="btn btn-info" role="button"><?php echo $add;?></a>
    </div>
</div>
<div id="content">
    <table class="table table-dark">
        <thead>
        <tr>
            <th scope="col"><?php echo $surname;?></th>
            <th scope="col"><?php echo $lastname;?></th>
            <th scope="col"><?php echo $phones;?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $data = $_SESSION['data'];
        foreach($data as $array)
        foreach($array as $objects) :?>
        <tr>
            <td> <?php echo $objects->name;; ?></td>
            <td> <?php echo $objects->lastName;; ?></td>
            <td> <?php echo $objects->phone1;; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $objects->phone2;; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                <?php echo $objects->phone3;; ?>
            </td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>

    <br><br>
    <a id="log-out-link" href="logout.php" class="btn btn-info" role="button"><?php echo $signout;?></a>
</div>
</body>
</html>