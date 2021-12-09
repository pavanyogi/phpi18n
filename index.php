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

?>
<!DOCTYPE html>
<html lang="<?= str_replace('_', '-', $locale) ?>">
<head>
    <meta charset="UTF-8">
    <title><?= _('Example') ?></title>
</head>
<body>

    <h1><?= _('Home') ?></h1>

    <p><?= _('Hello and welcome!') ?></p>

</body>
</html>
