<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderMeasurement extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_product_id', 'method', 'standard_measurement_id', 'fit_option_id', 'height', 'weight', 'cloth_measurement_id', 'pants_measurement_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function clothMeasurement()
    {
        return $this->belongsTo(ClothMeasurement::class);
    }

    public function pantsMeasurement()
    {
        return $this->belongsTo(PantsMeasurement::class);
    }
}
