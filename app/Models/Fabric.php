<?php

namespace App\Models;

class Fabric extends BaseModel
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

    protected $attributes = [
        'description' => '',
        'description_ind' => ''
    ];

    public function fabricColors()
    {
        return $this->hasMany(FabricColor::class);
    }

    public function fabricType()
    {
        return $this->belongsTo(FabricType::class);
    }

    public static function getByFabricColor($fabricColorId)
    {
        return self::where('fabric_colors.id', $fabricColorId)
            ->leftJoin('fabric_colors', 'fabric_colors.fabric_id', '=', 'fabrics.id')->first();
    }
}
