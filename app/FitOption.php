<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FitOption extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function defaultMeasurements()
    {
        return $this->hasMany(DefaultMeasurement::class);
    }
}
