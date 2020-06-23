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
        'name', 'base_price', 'product_id'
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

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}