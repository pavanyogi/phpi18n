<?php

if (substr($_SERVER['HTTP_HOST'], -6) == '.co.uk') {

    $lang = 'en';

} elseif (substr($_SERVER['HTTP_HOST'], -3) == '.es') {

    $lang = 'es';

}

if ($lang == 'en') {

    $trans = [
        'title' => 'Example',
        'header' => 'Home',
        'welcome' => 'Hello and welcome!'
    ];

} elseif ($lang == 'es') {

    $trans = [
        'title' => 'Ejemplo',
        'header' => 'Inicio',
        'welcome' => '¡Hola y bienvenido!'
    ];

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $trans['title'] ?></title>
</head>
<body>

    <h1><?= $trans['header'] ?></h1>

    <p><?= $trans['welcome'] ?></p>

</body>
</html>
