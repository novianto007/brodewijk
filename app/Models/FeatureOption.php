<?php

namespace App\Models;

class FeatureOption extends BaseModel
{
    public $resourceData = array();

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'is_has_child', 'description', 'description_ind', 'feature_id', 'resources', 'code_name', 'resource_depend'
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

    public function delete()
    {
        parent::delete();
        FeatureOptionChild::where('feature_option_id', $this->id)->delete();
    }

    public function featureOptionChildren()
    {
        return $this->hasMany(FeatureOptionChild::class);
    }

    public function featurePrices()
    {
        return $this->hasMany(FeaturePrice::class);
    }

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    public function depend()
    {
        return $this->belongsTo(Feature::class, 'resource_depend');
    }

    public static function insertDefaultValue($featureId)
    {
        $defaultVal = [
            [
                'feature_id' => $featureId,
                'name' => 'none',
                'image' => '',
                'is_has_child' => 0,
                'description' => '',
                'description_ind' => '',
                'code_name' => null,
                'resource_depend' => null,
                'resources' => null
            ],
            [
                'feature_id' => $featureId,
                'name' => 'add',
                'image' => '',
                'is_has_child' => 0,
                'description' => '',
                'description_ind' => '',
                'code_name' => null,
                'resource_depend' => null,
                'resources' => null
            ]
        ];
        self::insert($defaultVal);
    }
}
