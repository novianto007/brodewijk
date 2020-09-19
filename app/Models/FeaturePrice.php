<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturePrice extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fabric_type_id', 'feature_option_id', 'price', 'price_margin'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $attributes = [
        'price_margin' => 0.0
    ];

    public function fabricType()
    {
        return $this->belongsTo(FabricType::class);
    }

    public function featureOption()
    {
        return $this->belongsTo(FeatureOption::class);
    }

    public static function getByOptionAndFabricType($option, $fabricType)
    {
        return self::where('feature_option_id', $option)->where('fabric_type_id', $fabricType)->first();
    }
}
