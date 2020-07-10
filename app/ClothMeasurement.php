<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClothMeasurement extends Model
{
    public static $MAX_SHOULDER_WIDTH = 47;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'front_length', 'shoulder_width', 'sleeve_length', 'chest', 'waist', 'hips', 'armpits', 'biceps', 'wrist', 'front_chest', 'back_chest'
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public static function isExtraSize($size)
    {
        if ($size > self::$MAX_SHOULDER_WIDTH) {
            return true;
        }
        return false;
    }
}
