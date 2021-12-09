<?php

require 'src/App/I18n.php';

$i18n = new App\I18n(['en_GB', 'es']);

list($subdomain, $domain) = explode('.', $_SERVER['HTTP_HOST'], 2);

$lang = $i18n->getBestMatch($subdomain);

var_dump($_SERVER['HTTP_ACCEPT_LANGUAGE']);

print_r($i18n->getAcceptedLocales());

if ($lang === null) {
  
    $default = substr($i18n->getDefault(), 0, 2);
    
    header("Location: http://" . $default . ".phpi18n.localhost/");
    exit;
      
}

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
<html lang="<?= str_replace('_', '-', $lang) ?>">
<head>
    <meta charset="UTF-8">
    <title><?= $trans['title'] ?></title>
</head>
<body>

    <h1><?= $trans['header'] ?></h1>

    <p><?= $trans['welcome'] ?></p>

</body>
</html>
