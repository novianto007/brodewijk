<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fabric extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'brand', 'grade', 'description', 'fabric_type_id'
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function fabricColors()
    {
        return $this->hasMany(FabricColor::class);
    }

    public function fabricType()
    {
        return $this->belongsTo(FabricType::class);
    }
}