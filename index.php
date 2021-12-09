<?php

require __DIR__.'/src/App/I18n.php';
require __DIR__.'/vendor/autoload.php';

$i18n = new App\I18n(['en_GB', 'es_ES']);

list($subdomain, $domain) = explode('.', $_SERVER['HTTP_HOST'], 2);

$locale = $i18n->getBestMatch($subdomain);

if ($locale === null) {
  
    $locale = $i18n->getLocaleForRedirect(); 
  
    $subdomain = substr($locale, 0, 2);
    
    header("Location: http://" . $subdomain . ".phpi18n.localhost/");
    exit;
      
}

PhpMyAdmin\MoTranslator\Loader::loadFunctions();

_setlocale(LC_ALL, $locale);

$domain = 'messages';

_textdomain($domain);

_bindtextdomain($domain, 'locales');

_bind_textdomain_codeset($domain, 'UTF-8');

?>
<!DOCTYPE html>
<html lang="<?= str_replace('_', '-', $locale) ?>">
<head>
    <meta charset="UTF-8">
    <title><?= __('Example') ?></title>
</head>
<body>

    <h1><?= __('Home') ?></h1>

    <p><?= __('Hello and welcome!') ?></p>

    <p><?= __('Thank you') ?></p>

</body>
</html>
