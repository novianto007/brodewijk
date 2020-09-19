<?php

namespace App\Http\Controllers;

use App\Models\FabricType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FabricTypeController extends Controller
{
    /**
     * Get the measurement.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $fabricTypeInput = $request->all();
        $this->customValidate($request, $fabricTypeInput, [
            'category_id' => 'required|integer|exists:categories,id',
            'name' => 'required|string',
            'base_price' => 'required|numeric',
            'extra_price' => 'required|numeric',
            'base_price_margin' => 'numeric',
            'extra_price_margin' => 'numeric',
            'features' => 'required|array',
        ]);

        $features = $request['features'];
        $this->customValidate($request, compact('features'), [
            'features.*.feature_option_id' => 'required|integer|exists:feature_options,id',
            'features.*.price' => 'required|numeric',
            'features.*.price_margin' => 'numeric'
        ]);

        $fabricType = DB::transaction(function () use ($fabricTypeInput, $features) {
            $fabricType = FabricType::create($fabricTypeInput);
            $fabricType->featurePrices()->createMany($features);
            return $fabricType;
        });
        return $this->response(false, 'success', $fabricType);
    }
}
