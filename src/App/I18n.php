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
    
    private function getDefault()
    {
        return $this->supported_locales[0];      
    } 
    
    private function getAcceptedLocales()
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
    
    private function getBestMatchFromHeader()
    {
        $accepted_locales = $this->getAcceptedLocales();
        
        array_walk($accepted_locales, function(&$locale) {

            $locale = \Locale::canonicalize($locale);

        });
        
        foreach ($accepted_locales as $locale) {
                      
            if (in_array($locale, $this->supported_locales)) {
            
                return $locale;
              
            }                      
        }        
                    
        foreach ($accepted_locales as $locale) {
        
            $lang = substr($locale, 0, 2);
            
            foreach ($this->supported_locales as $supported_locale) {
              
                if (substr($supported_locale, 0, 2) == $lang) {
                
                    return $supported_locale;
                  
                }
            }
        }
                    
        return null;
    }
    
    public function getLocaleForRedirect()
    {
        // $locale = $this->getBestMatchFromHeader();
        
        // if ($locale !== null) {
          
        //     return $locale;          
                  
        // }
        
        $locale = $this->getBestMatchFromIPAddress();
        
        if ($locale !== null) {
          
            return $locale;          
                  
        }
        
        return $this->getDefault();        
    }

    private function getBestMatchFromIPAddress()
    {
        try {

            $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__.'/../..');
            $dotenv->load();

            $client = new \ipinfo\ipinfo\IPinfo($_ENV['SECRET_KEY_IPINFO']);
            
            // $details = $client->getDetails($_SERVER['REMOTE_ADDR']);
            $details = $client->getDetails('207.228.238.7');

            var_dump($details);
            exit;
                                    
            if (isset($details->country)) {
            
                return $this->getBestMatch($details->country);
              
            }            
            
        } catch (\ipinfo\ipinfo\IPinfoException $e) {

            echo $e->getMessage();

        }            
    }
}















