<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClothMeasurement extends Model
{
    public static $MAX_SHOULDER = 47;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'neck', 'shoulder', 'bicep', 'chest', 'waist', 'arm_length', 'torso_length', 'stomach', 'wrist'
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public static function isExtraSize($size)
    {
        if ($size > self::$MAX_SHOULDER) {
            return true;
        }
        return false;
    }
}
