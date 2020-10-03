<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\FeatureOption;
use App\Repositories\FeatureRepository;
use Illuminate\Support\Facades\DB;

class FeatureController extends Controller
{
    public function getAll(FeatureRepository $reporsitory)
    {
        return $this->response(false, 'success', $reporsitory->getAll());
    }

    /**
     * save feature.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $featureInput = $request->all();
        $this->customValidate($request, $featureInput, [
            'category_id' => 'required|integer|exists:categories,id',
            'name' => 'required|string',
            'name_ind' => 'string',
            'type' => 'required|string|in:option,value',
            'description' => 'string',
            'resource_depend' => 'integer|nullable|exists:features,id',
        ]);
        $feature = DB::transaction(function () use ($featureInput) {
            $feature = Feature::create($featureInput);
            if ($featureInput['resource_depend'] != null) {
                Feature::find($featureInput['resource_depend'])->updateResourceDepend($feature->id);
            }
            if ($feature->type == 'value') {
                FeatureOption::insertDefaultValue($feature->id);
            }
            return $feature;
        });

        return $this->response(false, 'success', $feature);
    }

    public function destroy($id)
    {
        $feature = Feature::find($id);
        if ($feature) {
            if ($feature->type == 'option' && $feature->featureOptions()->count()) {
                return $this->response(true, 'Feature is used by another resource', null, 400);
            }
            $feature->delete();
            FeatureOption::where('feature_id', $id)->delete();
            return $this->response(false, 'success', null, 200);
        }
        return $this->response(true, 'Not Found', null, 404);
    }
}
