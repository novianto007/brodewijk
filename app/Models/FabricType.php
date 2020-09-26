<?php

namespace App\Models;

class FabricType extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'base_price', 'extra_price', 'base_price_margin', 'extra_price_margin', 'category_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $attributes = [
        'base_price_margin' => 0.0,
        'extra_price_margin' => 0.0
    ];

    public function delete()
    {
        FeaturePrice::where('fabric_type_id', $this->id)->delete();
        parent::delete();
    }

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
        return $this->belongsTo(Category::class);
    }
}
