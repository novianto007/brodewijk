<?php

namespace App\Models;

class FabricColor extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'code', 'fabric_id'
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function fabric()
    {
        return $this->belongsTo(Fabric::class);
    }
}
