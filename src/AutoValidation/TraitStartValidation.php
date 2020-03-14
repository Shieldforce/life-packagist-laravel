<?php

namespace SiefPackage\AutoValidation;

trait TraitStartValidation
{
    /**
     * Method boot is Model
     * Start Validation (self::observe(new ObserverValidation))
     */
    protected static function boot()
    {
        parent::boot();
        self::observe(new ObserverValidation);
    }
}
