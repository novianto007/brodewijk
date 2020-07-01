<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClothMeasurement extends Model
{

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
}