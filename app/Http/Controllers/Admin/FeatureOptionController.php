<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\FeatureOption;
use App\Repositories\FeatureOptionRepository;
use Illuminate\Support\Facades\DB;

class FeatureOptionController extends Controller
{
    public function getAll(FeatureOptionRepository $reporsitory)
    {
        return $this->response(false, 'success', $reporsitory->getAll());
    }

    /**
     * save feature option.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $featureInput = $this->validateFeatureOption($request, $request->all());

        $feature = Feature::find($featureInput['feature_id']);
        if ($feature->type == 'value') {
            return $this->response(true, 'Feature with type value can not have options', null, 400);
        }

        $featureInput['resource_depend'] = $feature->resource_depend;

        $optionChildren = $this->getOptionChildren($featureInput['is_has_child'], $request);

        $featureOption = DB::transaction(function () use ($featureInput, $optionChildren) {
            $featureOption = FeatureOption::create($featureInput);
            if ($featureOption->is_has_child) {
                $featureOption->featureOptionChildren()->createMany($optionChildren);
            }
            return $featureOption;
        });

        return $this->response(false, 'success', $featureOption);
    }

    public function destroy($id)
    {
        $featureOption = FeatureOption::find($id);
        if ($featureOption) {
            $featureOption->delete();
            return $this->response(false, 'success', null, 200);
        }
        return $this->response(true, 'Not Found', null, 404);
    }

    private function validateFeatureOption($request, $featureInput)
    {
        $this->customValidate($request, $featureInput, [
            'feature_id' => 'required|integer|exists:features,id',
            'name' => 'required|string',
            'image' => 'string|nullable',
            'is_has_child' => 'required|boolean',
            'description' => 'string',
            'description_ind' => 'string',
            'resources' => 'array|nullable',
            'code_name' => 'required|string',
            'option_children' => 'array|required_if:is_has_child,true'
        ]);

        if (is_array($featureInput['resources'])) {
            $featureInput['resources'] = $this->validateResources($request, $featureInput['resources']);
        }

        return $featureInput;
    }

    private function getOptionChildren($isHasChild, $request)
    {
        $optionChildren = array();
        if ($isHasChild) {
            $optionChildren = $request['option_children'];
            $this->customValidate($request, ['option_children' => $optionChildren], [
                'option_children.*.name' => 'required|string',
                'option_children.*.image' => 'string|nullable',
                'option_children.*.resources' => 'array|nullable',
            ]);

            foreach ($optionChildren as $key => $val) {
                if (isset($val['resources']) && is_array($val['resources'])) {
                    $optionChildren[$key]['resources'] = $this->validateResources($request, $val['resources']);
                }
            }
        }
        return $optionChildren;
    }

    private function validateResources($request, $resources)
    {
        $this->customValidate($request, compact('resources'), [
            'resources.*.position' => 'required|string',
            'resources.*.name' => 'required|string',
        ]);

        $result = [];
        foreach ($resources as $resource) {
            $result[$resource['position']] = $resource['name'];
        }
        return serialize($result);
    }
}
