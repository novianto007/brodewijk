<?php

namespace App\Http\Controllers;

use App\ClothMeasurement;
use App\Fabric;
use App\FeatureOptionChild;
use App\FeaturePrice;
use App\Order;
use App\PantsMeasurement;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addToCart(Request $request)
    {
        $productInput = $this->validateProduct($request);
        $fabric = Fabric::getByFabricColor($request['fabric_color_id']);
        $product = Product::find($request['product_id']);
        $featuresInput = $this->validateFeatures($request, $fabric->fabric_type_id);
        $measurementInput = $this->validateMeasurement($request);
        $extraPrice = 0;

        if (in_array($product->category->type, ['suit', 'cloth'])) {
            $cloth = $this->validateCloth($request, $measurementInput);
            if (ClothMeasurement::isExtraSize($cloth['shoulder_width'])) {
                $extraPrice += $fabric->fabricType->extra_price;
            }
        }

        if (in_array($product->category->type, ['suit', 'pants'])) {
            $pants = $this->validatePants($request, $measurementInput);
            if (PantsMeasurement::isExtraSize($pants['trouser_waist'])) {
                $extraPrice += $fabric->fabricType->extra_price;
            }
        }
        $productInput['fabric_price'] = $fabric->fabricType->base_price;
        $productInput['product_price'] = $productInput['fabric_price'] + $featuresInput['totalPrice'] + $extraPrice;
        $order = Order::saveCart($productInput, $measurementInput, $featuresInput['features'], $cloth, $pants);
        return $this->response(false, "success", $order);
    }

    private function validateProduct($request)
    {
        $input = $request->all();
        $this->customValidate($request, $input, [
            'fabric_color_id' => 'required|integer|exists:fabric_colors,id',
            'product_id' => 'required|integer|exists:products,id',
            'is_customized' => 'required|boolean',
            'note' => 'string',
            'features' => 'required|array',
            'measurement' => 'required|array',
        ]);
        return $input;
    }

    private function validateMeasurement($request)
    {
        $measurement = $request['measurement'];
        $this->customValidate($request, compact('measurement'), [
            'measurement.method' => 'required|in:manual,standard',
            'measurement.standard_measurement_id' => 'required_if:measurement.method,standard',
            'measurement.fit_option_id' => 'required|integer',
            'measurement.height' => 'required|numeric',
            'measurement.weight' => 'required|numeric',
            'measurement.cloth' => 'nullable|array',
            'measurement.pants' => 'nullable|array',
        ]);
        return $measurement;
    }

    private function validatePants($request, $measurement)
    {
        $pants = $measurement['pants'];
        $this->customValidate($request, compact('pants'), [
            'pants.trouser_waist' => 'required|integer',
            'pants.crotch' => 'required|integer',
            'pants.thigh' => 'required|integer',
            'pants.knee' => 'required|integer',
            'pants.ankle' => 'required|integer',
            'pants.pants_length' => 'required|integer',
            'pants.pants_hips' => 'required|integer',
        ]);
        return $pants;
    }

    private function validateCloth($request, $measurement)
    {
        $cloth = $measurement['cloth'];
        $this->customValidate($request, compact('cloth'), [
            'cloth.front_length' => 'required|numeric',
            'cloth.shoulder_width' => 'required|numeric',
            'cloth.sleeve_length' => 'required|numeric',
            'cloth.chest' => 'required|numeric',
            'cloth.waist' => 'required|numeric',
            'cloth.hips' => 'required|numeric',
            'cloth.armpits' => 'required|numeric',
            'cloth.biceps' => 'required|numeric',
            'cloth.wrist' => 'required|numeric',
            'cloth.front_chest' => 'required|numeric',
            'cloth.back_chest' => 'required|numeric',
        ]);
        return $cloth;
    }

    private function validateFeatures(Request $request, $fabricTypeId)
    {
        $features = $request['features'];
        $this->customValidate($request, compact('features'), [
            'features.*.option_value' => 'required|integer',
            'features.*.child_value' => 'nullable|integer',
            'features.*.string_value' => 'nullable|string',
        ]);

        $error = [];
        $totalPrice = 0;
        for ($i = 0; $i < sizeof($features); $i++) {
            $featurePrice = FeaturePrice::getByOptionAndFabricType($features[$i]['option_value'], $fabricTypeId);
            if (!$featurePrice) {
                $error['option_value'] = 'invalid option value';
                break;
            }
            $features[$i]['price'] = $featurePrice->price;
            $features[$i]["feature_id"] = $featurePrice->featureOption->feature->id;
            if ($featurePrice->featureOption->is_has_child) {
                $child = FeatureOptionChild::find($features[$i]['child_value']);
                if (!$child) {
                    $error['child_value'] = 'invalid child value';
                    break;
                }
            }

            if ($featurePrice->featureOption->feature->type == 'value') {
                if ($featurePrice->featureOption->name == "Add") {
                    if (!$features[$i]['string_value']) {
                        $error['string_value'] = 'invalid child value';
                        break;
                    }
                }
            }
            $totalPrice += $featurePrice->price;
        }
        $this->checkError($request, $error);
        return compact('totalPrice', 'features');
    }

    private function checkError($request, $error)
    {
        if (sizeof($error) > 0) {
            $exception = ValidationException::withMessages($error);
            $exception->response = $this->buildFailedValidationResponse($request, $error);
            throw $exception;
        }
    }
}
