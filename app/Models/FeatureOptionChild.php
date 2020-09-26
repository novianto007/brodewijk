<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureOptionChild extends Model
{
    public $resourceData = array();

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'resources', 'feature_option_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected static function booted()
    {
        static::retrieved(function ($model) {
            if ($model->resources) {
                $model->resourceData = unserialize($model->resources);
            }
            return true;
        });

        static::creating(function ($model) {
            if (sizeof($model->resourceData) > 0) {
                $model->resources = serialize($model->resourceData);
            }
            return true;
        });
    }

    public function featureOption()
    {
        return $this->belongsTo(FeatureOption::class);
    }
}
