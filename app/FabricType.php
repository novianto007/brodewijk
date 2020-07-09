<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FabricType extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'base_price', 'category_id'
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function fabrics()
    {
        return $this->hasMany(Fabric::class);
    }

    public function featurePrices()
    {
        return $this->hasMany(FeaturePrice::class);
    }

    public function category()
    {
        return $this->belongsTo(category::class);
    }
}