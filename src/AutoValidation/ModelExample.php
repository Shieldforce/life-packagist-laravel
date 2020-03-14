<?php

namespace ShieldforcePackage\AutoValidation;

use Illuminate\Database\Eloquent\Model;

class ModelExample extends Model
{
    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * @var array
     */
    protected $table = ['example'];

    /**
     * Start ObserverValidation
     */
    use TraitStartValidation;

    /**
     * @var array
     */
    public static $rules =
        [
            'retrieved'       => [],
            'creating'        => [],
            'created'         => [],
            'updating'        => [],
            'updated'         => [],
            'saving'          => [],
            'saved'           => [],
            'deleting'        => [],
            'deleted'         => [],
            'restoring'       => [],
            'restored'        => [],
        ];

    /**
     * Relations
     */
}