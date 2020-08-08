<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DefaultMeasurement extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'standard_measurement_id', 'fit_option_id', 'height', 'weight', 'cloth_measurement_id', 'pants_measurement_id'
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public static function findByOptionIdWithOrder($fitOptionId)
    {
        return self::where('fit_option_id', $fitOptionId)
            ->leftJoin('standard_measurements', 'standard_measurements.id', '=', 'default_measurements.standard_measurement_id')
            ->orderBy('standard_measurements.order')->get();
    }

    public function standardMeasurement()
    {
        return $this->belongsTo(StandardMeasurement::class);
    }

    public function fitOption()
    {
        return $this->belongsTo(FitOption::class);
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
