<?php

namespace App\Http\Controllers\Admin;

use App\Models\FabricType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\FabricTypeRepository;

class FabricTypeController extends Controller
{
    public function getAll(FabricTypeRepository $reporsitory)
    {
        return $this->response(false, 'success', $reporsitory->getAll());
    }

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

    public function destroy($id)
    {
        $fabricType = FabricType::find($id);
        if ($fabricType) {
            if ($fabricType->fabrics()->count()) {
                return $this->response(true, 'Fabric Type is used by another resource', null, 400);
            }
            $fabricType->delete();
            return $this->response(false, 'success', null, 200);
        }
        return $this->response(true, 'Not Found', null, 404);
    }
}
