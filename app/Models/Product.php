<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fabric_id', 'fabric_color_id', 'category_id', 'name', 'description', 'image', 'is_default', 'slug'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public static function getBySlug($categorySlug, $productSlug)
    {
        return self::where('products.slug', $productSlug)->where('categories.slug', $categorySlug)
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->orWhere('is_default', 1)->select('products.*')->first();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function fabric()
    {
        return $this->belongsTo(Fabric::class);
    }

    public function fabricColor()
    {
        return $this->belongsTo(FabricColor::class);
    }

    public function productFeatures()
    {
        return $this->hasMany(ProductFeature::class);
    }
}
