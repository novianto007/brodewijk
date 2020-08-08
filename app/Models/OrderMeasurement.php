<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderMeasurement extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_product_id', 'method', 'standard_measurement_id', 'fit_option_id', 'height', 'weight', 'cloth_measurement_id', 'pants_measurement_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public static function saveCart($measurement, $cloth, $pants, $extraPrice)
    {
        return DB::transaction(function () use ($measurement, $cloth, $pants, $extraPrice) {
            $measurement = self::create($measurement);
            if ($cloth) {
                $cloth = ClothMeasurement::create($cloth);
                $measurement->clothMeasurement()->associate($cloth);
            }
            if ($pants) {
                $pants = PantsMeasurement::create($pants);
                $measurement->pantsMeasurement()->associate($pants);
            }
            $measurement->save();

            $measurement->orderProduct->updateExtraPrice($extraPrice);
            return $measurement;
        });
    }

    public function updateCart($measurement, $cloth, $pants, $extraPrice)
    {
        return DB::transaction(function () use ($measurement, $cloth, $pants, $extraPrice) {
            $this->update($measurement);
            if ($cloth) {
                if ($this->clothMeasurement()) {
                    $this->clothMeasurement()->update($cloth);
                } else {
                    $cloth = ClothMeasurement::create($cloth);
                    $this->clothMeasurement()->associate($cloth);
                }
            } elseif ($this->clothMeasurement()) {
                $this->clothMeasurement()->delete();
            }

            if ($pants) {
                if ($this->pantsMeasurement()) {
                    $this->pantsMeasurement()->update($pants);
                } else {
                    $pants = PantsMeasurement::create($pants);
                    $this->pantsMeasurement()->associate($pants);
                }
            } elseif ($this->pantsMeasurement()) {
                $this->pantsMeasurement()->delete();
            }
            $this->save();

            $this->orderProduct->updateExtraPrice($extraPrice);
            return $this;
        });
    }

    public static function findByOrderProductId($id)
    {
        return self::where('order_product_id', $id)->first();
    }

    public function orderProduct()
    {
        return $this->belongsTo(OrderProduct::class);
    }

    public function clothMeasurement()
    {
        return $this->belongsTo(ClothMeasurement::class);
    }

    public function pantsMeasurement()
    {
        return $this->belongsTo(PantsMeasurement::class);
    }
}
