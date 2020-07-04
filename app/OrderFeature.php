<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderFeature extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_fabric_id', 'feature_id', 'option_value', 'child_value', 'string_value', 'price'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
