<?php

namespace App\Http\Localization;

use Faker\Provider\Base;
use Illuminate\Http\Request;

class Localization
{
    public static function setLocale($locale = null)
    {
        $locale = \LaravelLocalization::setLocale($locale);

        $subdomain = array_first(explode('.', \Request::getHost()));

        $locale = $locale ?? (in_array($subdomain, array_keys(\LaravelLocalization::getSupportedLocales())) ? \LaravelLocalization::setLocale($subdomain) : null);
        return $locale;
    }

    public static function setLocalePrefix($locale = null){
        $locale = self::setLocale($locale);

        if($locale){
            $locale = $locale . '.';
        }

        return $locale;
    }

}