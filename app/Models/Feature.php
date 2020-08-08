<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'description', 'category_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function featureOptions()
    {
        return $this->hasMany(FeatureOption::class);
    }
}