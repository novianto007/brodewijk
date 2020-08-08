<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FabricColor extends Model
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