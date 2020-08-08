<?php

namespace App\Models;

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

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function clothMeasurement()
    {
        return $this->belongsTo(ClothMeasurement::class);
    }

    public function pantsMeasurement()
    {
        return $this->belongsTo(PantsMeasurement::class);
    }
}
