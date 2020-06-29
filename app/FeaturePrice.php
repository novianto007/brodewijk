<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeaturePrice extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fabric_type_id', 'feature_option_id', 'price'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function fabricType()
    {
        return $this->belongsTo(FabricType::class);
    }

    public function featureOption()
    {
        return $this->belongsTo(FeatureOption::class);
    }
}
