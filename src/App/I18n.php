<?php

namespace App;

class I18n
{
    private $supported_locales;

    public function __construct(array $supported_locales)
    {
        $this->supported_locales = $supported_locales;
    }
}
