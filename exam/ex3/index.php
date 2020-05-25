<?php

require_once '../vendor/tpl.php';

$translations = ['red' => 'Punane', 'blue' => 'Sinine'];

// mallide teegi kasutamise näide
$data['fileName'] = 'content.html';
$data['color'] = 'Kollane';

if(isset($_POST['color'])){
    header('Location: ?color=' .urlencode($_POST['color']));
}
else if (isset($_GET['color'])){
    $data['color'] = $_GET['color'];

    if($data['color'] == 'red'){
        $data['color'] = 'Punane';
        print renderTemplate('content.html', $data);
    }
    else if($data['color'] == 'blue'){
        $data['color'] = 'Sinine';
        print renderTemplate('content.html', $data);
    }
}
else{
    $data['fileName'] = 'form.html';
    print renderTemplate('main.html', $data);
}










print renderTemplate('main.html', $data);
