<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\City;
use App\Models\District;
use App\Models\Province;
use App\Http\Resources\Customer\Address as AddressResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Instantiate a new CustomerController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $inputData = $request->all();
        $this->customValidate($request, $inputData, [
            'title' => 'required|string',
            'address' => 'required|string',
            'province_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'district_id' => 'required|numeric',
            'postcode' => 'required|numeric',
            'note' => 'nullable|string',
        ]);
        $inputData['customer_id'] = Auth::user()->id;
        $address = Address::create($inputData);
        return $this->response(false, 'success', new AddressResource($address));
    }

    public function getAll()
    {
        $addresses = Address::where('customer_id', Auth::user()->id)->get();
        return $this->response(false, 'success', AddressResource::collection($addresses));
    }

    public function getProvinces()
    {
        $provinces = Province::orderBy('name', 'asc')->all();
        return $this->response(false, 'success', $provinces);
    }

    public function getCities($provinceId)
    {
        $cities = City::where('province_id', $provinceId)->orderBy('name', 'asc')->get(['id', 'name']);
        if (sizeof($cities) == 0) {
            return $this->response(true, 'data not found', null, 404);
        }
        return $this->response(false, 'success', $cities);
    }

    public function getDistricts($cityId)
    {
        $districts = District::where('city_id', $cityId)->orderBy('name', 'asc')->get(['id', 'name']);
        if (sizeof($districts) == 0) {
            return $this->response(true, 'data not found', null, 404);
        }
        return $this->response(false, 'success', $districts);
    }
}
