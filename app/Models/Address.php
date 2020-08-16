<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'title', 'address', 'province_id', 'city_id', 'district_id', 'postcode', 'note'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'customer_id'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function toAddressString()
    {
        return sprintf(
            '%s\n, %s, %s, %s\n, IDN, %d',
            $this->address,
            $this->district->name,
            $this->city->name,
            $this->province_name,
            $this->postcode
        );
    }
}
