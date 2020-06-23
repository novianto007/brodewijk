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
    public function getAll($productSlug)
    {
        $data = Cache::get('fabric:' . $productSlug);
        if ($data == null) {
            $fabric = Fabric::where('products.slug', $productSlug)
                ->leftJoin('fabric_types', 'fabric_types.id', '=', 'fabrics.fabric_type_id')
                ->leftJoin('products', 'products.id', '=', 'fabric_types.product_id')
                ->select('fabrics.*')
                ->get();
            $data = FabricResource::collection($fabric);
            Cache::put('fabric:' . $productSlug, $data, 900);
        }
        return response()->json([$data], 200);
    }
}
