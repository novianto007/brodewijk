<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureOption extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'is_has_child', 'description', 'feature_id', 'resources', 'code_name', 'resource_depend'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function featureOptionChildren()
    {
        return $this->hasMany(FeatureOptionChild::class);
    }

    public function featurePrices()
    {
        return $this->hasMany(FeaturePrice::class);
    }

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    public function depend()
    {
        return $this->belongsTo(Feature::class, 'resource_depend');
    }
}
