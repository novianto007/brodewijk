<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PantsMeasurement extends Model
{
    public static $MAX_TROUSER_WAIST = 100;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pants_length', 'trouser_waist', 'crotch', 'thigh', 'knee', 'ankle', 'pants_hips'
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public static function isExtraSize($size)
    {
        if ($size > self::$MAX_TROUSER_WAIST) {
            return true;
        }
        return false;
    }
}
