<?php

namespace App\Http\Controllers;

use App\Models\FitOption;
use App\Models\SizePreference;
use App\Http\Resources\Customer\FitOption as FitOptionResource;
use App\Http\Resources\Customer\SizePreference as SizePreferenceResource;

class MeasurementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get the measurement.
     *
     * @return Response
     */
    public function getAll()
    {
        $user = app('auth')->user();
        $sizePreference = new SizePreferenceResource(
            SizePreference::where('customer_id', $user->id)->first()
        );
        $data['preference_size'] = $sizePreference;

        $fitOption = FitOption::all();
        $data['standard_size'] = FitOptionResource::collection($fitOption);
        return $this->response(false, 'success', $data);
    }
}
