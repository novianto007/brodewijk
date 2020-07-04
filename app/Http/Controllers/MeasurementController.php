<?php

namespace App\Http\Controllers;

use App\FitOption;
use App\SizePreference;
use Exception;
use App\Http\Resources\Customer\FitOption as FitOptionResource;
use App\Http\Resources\Customer\SizePreference as SizePreferenceResource;
use Tymon\JWTAuth\Facades\JWTAuth;

class MeasurementController extends Controller
{
    /**
     * Get the measurement.
     *
     * @return Response
     */
    public function getAll()
    {
        try {
            if ($token = JWTAuth::parseToken()) {
                $user = JWTAuth::toUser($token);
                $sizePreference = new SizePreferenceResource(
                    SizePreference::where('customer_id', $user->id)->first()
                );
            }
        } catch (Exception $e) {
            $sizePreference = null;
        }
        $data['preference_size'] = $sizePreference;

        $fitOption = FitOption::all();
        $data['standard_size'] = FitOptionResource::collection($fitOption);
        return $this->response(false, 'success', $data);
    }
}
