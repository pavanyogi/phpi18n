<?php

require 'src/App/I18n.php';

$i18n = new App\I18n(['en_GB', 'es']);

list($subdomain, $domain) = explode('.', $_SERVER['HTTP_HOST'], 2);

$locale = $i18n->getBestMatch($subdomain);

if ($locale === null) {
  
    $locale = $i18n->getLocaleForRedirect(); 
  
    $subdomain = substr($locale, 0, 2);
    
    header("Location: http://" . $subdomain . ".phpi18n.localhost/");
    exit;
      
}

if ($locale == 'en_GB') {

    $trans = [
        'title' => 'Example',
        'header' => 'Home',
        'welcome' => 'Hello and welcome!'
    ];

} elseif ($locale == 'es') {

    $trans = [
        'title' => 'Ejemplo',
        'header' => 'Inicio',
        'welcome' => '¡Hola y bienvenido!'
    ];

}

?>
<!DOCTYPE html>
<html lang="<?= str_replace('_', '-', $locale) ?>">
<head>
    <meta charset="UTF-8">
    <title><?= $trans['title'] ?></title>
</head>
<body>

    <h1><?= $trans['header'] ?></h1>

    <p><?= $trans['welcome'] ?></p>

</body>
</html>
