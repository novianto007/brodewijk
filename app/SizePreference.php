<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SizePreference extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fit_option_id', 'customer_id', 'height', 'weight', 'cloth_measurement_id', 'pants_measurement'
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function fitOption()
    {
        return $this->belongsTo(FitOption::class);
    }

    public function Customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function ClothMeasurement()
    {
        return $this->belongsTo(ClothMeasurement::class);
    }

    public function PantsMeasurement()
    {
        return $this->belongsTo(PantsMeasurement::class);
    }
}
