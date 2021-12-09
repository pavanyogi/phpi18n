<?php

namespace App;

class I18n
{
    private $supported_locales;

    public function __construct(array $supported_locales)
    {
        $this->supported_locales = $supported_locales;
    }

    public function getBestMatch(string $lang)
    {
        $lang = \Locale::canonicalize($lang);

        if (in_array($lang, $this->supported_locales)) {

            return $lang;

        } else {

            foreach ($this->supported_locales as $supported_locale) {

                if (substr($supported_locale, 0, 2) == $lang) {

                    return $supported_locale;

                }
            }
        }

        return null;
    }
    
    public function getDefault()
    {
        return $this->supported_locales[0];      
    } 
    
    public function getAcceptedLocales()
    {
        if ($_SERVER['HTTP_ACCEPT_LANGUAGE'] == '') {
        
            return [];
          
        }
        
        $accepted_locales = [];      
        
        $parts = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
        
        foreach ($parts as $part) {
          
            $locale_and_pref = explode(';q=', $part);
            
            $locale = trim($locale_and_pref[0]);
            $pref = $locale_and_pref[1] ?? 1.0;
          
            $accepted_locales[$locale] = $pref;
        }
        
        arsort($accepted_locales);
        
        return array_keys($accepted_locales);
    }
    
    public function getBestMatchFromHeader()
    {
        $accepted_locales = $this->getAcceptedLocales();
        
        foreach ($accepted_locales as $locale) {

            $locale = \Locale::canonicalize($locale);
                      
            if (in_array($locale, $this->supported_locales)) {
            
                return $locale;
              
            }                      
        }        
        
        return null;
    }    
}











