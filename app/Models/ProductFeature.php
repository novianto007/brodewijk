<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFeature extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'feature_id', 'option_value', 'child_value', 'string_value'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    public function optionValue()
    {
        return $this->belongsTo(FeatureOption::class, 'option_value');
    }

    public function childValue()
    {
        return $this->belongsTo(FeatureOptionChild::class, 'child_value');
    }
}