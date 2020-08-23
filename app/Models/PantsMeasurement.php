<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PantsMeasurement extends Model
{
    public static $MAX_WAIST = 100;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'waist', 'seat', 'crotch', 'thigh', 'knee', 'leg_length'
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public static function isExtraSize($size)
    {
        if ($size > self::$MAX_WAIST) {
            return true;
        }
        return false;
    }
}
