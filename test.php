<?php


$locale = "es_ES";
// $locale = "en";

putenv("LANG=" . $locale); 
setlocale(LC_ALL, $locale);
$domain = "messages";
bindtextdomain($domain, "locales");  // Also works like this
// bindtextdomain($domain, "/home/pavany/Documents/aux/qbix/telegram-bot/phpi18n/locales/");
bind_textdomain_codeset($domain, 'UTF-8');
textdomain($domain);
echo _("Example");
