<?php

namespace App\Http\Controllers;

use App\Models\ClothMeasurement;
use App\Models\Fabric;
use App\Models\FeatureOptionChild;
use App\Models\FeaturePrice;
use App\Http\Resources\Customer\Cart as CartResource;
use App\Models\Cart;
use App\Models\OrderMeasurement;
use App\Models\OrderProduct;
use App\Models\PantsMeasurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
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
        $productInput['fabric_id'] = $fabric->id;

        $cart = Cart::saveCart($productInput, $featuresInput['features'], Auth::user()->id);

        return $this->response(false, "success", $cart);
    }

    public function getCart()
    {
        $cart = Cart::where('customer_id', Auth::user()->id)->first();
        if ($cart == null) {
            return $this->response(false, "cart is empty", []);
        }
        return $this->response(false, "success", new CartResource($cart));
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
            if (ClothMeasurement::isExtraSize($cloth['shoulder'])) {
                $extraPrice += $fabric->fabricType->extra_price;
            }
        }

        if (in_array($orderProduct->product->category->type, ['suit', 'pants'])) {
            $pants = $this->validatePants($request, $measurement);
            if (PantsMeasurement::isExtraSize($pants['waist'])) {
                $extraPrice += $fabric->fabricType->extra_price;
            }
        }
        $orderMeasurement = OrderMeasurement::findByOrderProductId($id);
        if ($orderMeasurement) {
            $orderMeasurement->updateCart($measurement, $cloth, $pants, $extraPrice);
        } else {
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
            'features' => 'required|array'
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
            'pants.waist' => 'required|integer',
            'pants.seat' => 'required|integer',
            'pants.crotch' => 'required|integer',
            'pants.thigh' => 'required|integer',
            'pants.knee' => 'required|integer',
            'pants.leg_length' => 'required|integer',
        ]);
        return $pants;
    }

    private function validateCloth($request, $measurement)
    {
        $cloth = $measurement['cloth'];
        $this->customValidate($request, compact('cloth'), [
            'cloth.neck' => 'required|numeric',
            'cloth.shoulder' => 'required|numeric',
            'cloth.bicep' => 'required|numeric',
            'cloth.chest' => 'required|numeric',
            'cloth.waist' => 'required|numeric',
            'cloth.arm_length' => 'required|numeric',
            'cloth.torso_length' => 'required|numeric',
            'cloth.stomach' => 'required|numeric',
            'cloth.wrist' => 'required|numeric',
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
