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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addToCart(Request $request)
    {
        $orderInput = $this->validateOrder($request);

        $fabric = Fabric::where('fabric_colors.id', $request['fabric_color_id'])
            ->leftJoin('fabric_colors', 'fabric_colors.fabric_id', '=', 'fabrics.id')->first();
        $product = Product::find($request['product_id']);

        $features = $this->validateFeatures($request, $fabric);

        $measurementInput = $this->validateMeasurement($request);

        if (in_array($product->category->type, ['suit', 'cloth'])) {
            $cloth = $this->validateCloth($request, $measurementInput);
        }

        if (in_array($product->category->type, ['suit', 'pants'])) {
            $pants = $this->validatePants($request, $measurementInput);
        }

        $order = DB::transaction(function () use ($orderInput, $measurementInput, $product, $fabric, $features, $cloth, $pants) {
            $orderInput['category_id'] = $product->category_id;
            $orderInput['price'] = $fabric->fabricType->base_price + $features['totalPrice'];
            $order = Order::create($orderInput);
            $orderFabric = $order->orderFabric()->create([
                'fabric_id' => $fabric->id,
                'fabric_color_id' => $orderInput['fabric_color_id'],
                'price' => $fabric->fabricType->base_price,
            ]);
            $orderFabric->orderFeatures()->createMany($features['features']);
            $measurement = $order->orderMeasurement()->create($measurementInput);
            if ($cloth) {
                $cloth = ClothMeasurement::create($cloth);
                $measurement->clothMeasurement()->associate($cloth);
            }
            if ($pants) {
                $pants = PantsMeasurement::create($pants);
                $measurement->pantsMeasurement()->associate($pants);
            }
            $measurement->save();
            return $order;
        });

        return $this->response(false, "success", $order);
    }

    private function validateOrder($request)
    {
        $order = $request->all();
        $this->customValidate($request, $order, [
            'fabric_color_id' => 'required|integer|exists:fabric_colors,id',
            'product_id' => 'required|integer|exists:products,id',
            'is_customized' => 'required|boolean',
            'note' => 'string',
            'features' => 'required|array',
            'measurement' => 'required|array',
        ]);
        $order['customer_id'] = Auth::user()->id;
        return $order;
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

    private function validateFeatures(Request $request, $fabric)
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
            $price = FeaturePrice::where('feature_option_id', $features[$i]['option_value'])
                ->where('fabric_type_id', $fabric->fabric_type_id)->first();
            if (!$price) {
                $error['option_value'] = 'invalid option value';
                break;
            }
            $features[$i]['price'] = $price->price;
            $feature = $price->featureOption->feature;
            $features[$i]["feature_id"] = $feature->id;
            if ($price->featureOption->is_has_child) {
                $child = FeatureOptionChild::find($features[$i]['child_value']);
                if (!$child) {
                    $error['child_value'] = 'invalid child value';
                    break;
                }
            }

            if ($feature->type == 'value') {
                if ($price->featureOption->name == "Add") {
                    if (!$features[$i]['string_value']) {
                        $error['string_value'] = 'invalid child value';
                        break;
                    }
                }
            }
            $totalPrice += $price->price;
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
