<?php

namespace App\Http\Controllers;

use App\ClothMeasurement;
use App\Fabric;
use App\FeatureOptionChild;
use App\FeaturePrice;
use App\Http\Resources\Customer\Cart;
use App\Order;
use App\OrderMeasurement;
use App\OrderProduct;
use App\PantsMeasurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $featuresInput = $this->validateFeatures($request, $fabric->fabric_type_id);

        $productInput['fabric_price'] = $fabric->fabricType->base_price;
        $productInput['product_price'] = $productInput['fabric_price'] + $featuresInput['totalPrice'];
        $productInput['description'] = $featuresInput['description'];

        $order = Order::saveCart($productInput, $featuresInput['features'], Auth::user()->id);

        return $this->response(false, "success", $order);
    }

    public function getCart()
    {
        $order = Order::getCartData(Auth::user()->id);
        if ($order == null) {
            return $this->response(false, "cart is empty", null);
        }
        return $this->response(false, "success", new Cart($order));
    }

    public function addMeasurement(Request $request, $id)
    {
        $measurement = $this->validateMeasurement($request);
        $orderProduct = OrderProduct::find($id);
        if ($orderProduct == null) {
            return $this->response(true, "cart item not found", null, 404);
        }
        $measurement['order_product_id'] = $id;
        $fabric = Fabric::getByFabricColor($orderProduct->fabric_color_id);
        $extraPrice = 0;
        if (in_array($orderProduct->product->category->type, ['suit', 'cloth'])) {
            $cloth = $this->validateCloth($request, $measurement);
            if (ClothMeasurement::isExtraSize($cloth['shoulder_width'])) {
                $extraPrice += $fabric->fabricType->extra_price;
            }
        }

        if (in_array($orderProduct->product->category->type, ['suit', 'pants'])) {
            $pants = $this->validatePants($request, $measurement);
            if (PantsMeasurement::isExtraSize($pants['trouser_waist'])) {
                $extraPrice += $fabric->fabricType->extra_price;
            }
        }
        $orderMeasurement = OrderMeasurement::findByOrderProductId($id);
        if($orderMeasurement){
            $orderMeasurement->updateCart($measurement, $cloth, $pants, $extraPrice);
        }else{
            $orderMeasurement = OrderMeasurement::saveCart($measurement, $cloth, $pants, $extraPrice);
        }
        return $this->response(false, "success", $orderMeasurement);
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
        $this->customValidate($request, $request->all(), [
            'method' => 'required|in:manual,standard',
            'standard_measurement_id' => 'required_if:method,standard',
            'fit_option_id' => 'required|integer',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'cloth' => 'nullable|array',
            'pants' => 'nullable|array',
        ]);
        return $request->all();
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
        $description = '';
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
                    $description .= $featurePrice->featureOption->feature->name . ', ';
                }
            } else {
                $description .= $featurePrice->featureOption->name . ', ';
            }
            $totalPrice += $featurePrice->price;
        }
        $this->checkError($request, $error);
        return compact('totalPrice', 'features', 'description');
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
