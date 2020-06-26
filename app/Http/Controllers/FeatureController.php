<?php

namespace App\Http\Controllers;

use App\Feature;
use App\Http\Resources\Customer\Fabric as FabricResource;
use Illuminate\Support\Facades\Cache;

class FeatureController extends Controller
{
    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function getAll($categorySlug)
    {
        $data = Cache::get('feature:' . $categorySlug);
        if ($data == null) {
            $fabric = Feature::where('categories.slug', $categorySlug)
                ->leftJoin('categories', 'categories.id', '=', 'features.category_id')
                ->select('features.*')
                ->get();
            $data = FabricResource::collection($fabric);
            Cache::put('feature:' . $categorySlug, $data, 900);
        }
        return response()->json([$data], 200);
    }
}
