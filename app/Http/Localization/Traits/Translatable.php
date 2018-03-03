<?php

namespace App\Http\Localization\Traits;


trait Translatable
{
    use \Dimsav\Translatable\Translatable;

    /**
     * Set the default locale on the model.
     *
     * @param $locale
     *
     * @return $this
     */
    public function setLocale($locale)
    {
        return $this->setDefaultLocale($locale);
    }




}
