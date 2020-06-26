<?php

namespace App\Http\Controllers;

use App\Fabric;
use App\Http\Resources\Customer\Fabric as FabricResource;
use Illuminate\Support\Facades\Cache;

class FabricController extends Controller
{
    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function getAll($categorySlug)
    {
        $data = Cache::get('fabric:' . $categorySlug);
        if ($data == null) {
            $fabric = Fabric::where('categories.slug', $categorySlug)
                ->leftJoin('fabric_types', 'fabric_types.id', '=', 'fabrics.fabric_type_id')
                ->leftJoin('categories', 'categories.id', '=', 'fabric_types.category_id')
                ->select('fabrics.*')
                ->get();
            $data = FabricResource::collection($fabric);
            Cache::put('fabric:' . $categorySlug, $data, 900);
        }
        return response()->json([$data], 200);
    }
}
