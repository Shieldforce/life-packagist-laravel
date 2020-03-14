<?php

namespace ShieldforcePackage\AutoValidation;

use Illuminate\Database\Eloquent\Model;

class ModelExample extends Model
{
    /**
     * Start ObserverValidation
     * Method (Optional) for Trait
     */
    use TraitStartValidation;

    /**
     * Start ObserverValidation
     * Method (Main) for Boot
     */
    protected static function boot()
    {
        parent::boot();
        self::observe(new ObserverValidation);
    }

    /**
     * @var array
     * These are the classes that intercept the laravel action functions
     */
    public static $rules =
        [
            'creating'        => [],
            'updating'        => [],
            'saving'          => [],
            'deleting'        => [],
            'restoring'       => [],
        ];
}