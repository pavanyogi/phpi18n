<?php

require 'src/App/I18n.php';

$i18n = new App\I18n(['en_GB', 'es']);

list($subdomain, $domain) = explode('.', $_SERVER['HTTP_HOST'], 2);

$lang = Locale::canonicalize($subdomain);

var_dump($lang);

if ($lang == 'en_GB') {

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
