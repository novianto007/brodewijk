<?php

namespace App\Models;

class Feature extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'name_ind', 'type', 'description', 'category_id', 'resource_depend'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $attributes = [
        'name_ind' => '',
        'description' => ''
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function featureOptions()
    {
        return $this->hasMany(FeatureOption::class);
    }

    public function updateResourceDepend($featureId)
    {
        $this->resource_depend = $featureId;
        FeatureOption::where('feature_id', $this->id)->update(['resource_depend' => $featureId]);
        $this->save();
    }
}
