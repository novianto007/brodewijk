<?php

namespace App\Http\Controllers;

use App\Fabric;
use App\Http\Resources\Customer\Fabric as FabricResource;
use App\Http\Resources\Customer\Product as ProductResource;
use App\Http\Resources\Customer\ProductFeature as ProductFeatureResource;
use App\Product;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FabricController extends Controller
{
    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function getAll($categorySlug, $productSlug = null)
    {
        $cacheKey = 'fabric' . $categorySlug . $productSlug;
        $data = Cache::get($cacheKey);
        if ($data == null) {
            $product = $this->findProduct($categorySlug, $productSlug);
            $fabric = Fabric::where('category_id', $product->category->id)
                ->leftJoin('fabric_types', 'fabric_types.id', '=', 'fabrics.fabric_type_id')
                ->select('fabrics.*')->get();
            $data = [
                "product" => new ProductResource($product),
                "fabrics" => FabricResource::collection($fabric)->addExtraField($product)
            ];
            Cache::put($cacheKey, $data, 1);
        }
        return $this->response(false, 'success', $data);
    }

    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function getFeature($categorySlug, $productSlug = null)
    {
        $cacheKey = 'feature' . $categorySlug . $productSlug;
        $data = Cache::get($cacheKey);
        if ($data == null) {
            $product = $this->findProduct($categorySlug, $productSlug);
            $data = [
                "product" => new ProductResource($product),
                "features" => ProductFeatureResource::collection($product->productFeatures)
            ];
            Cache::put($cacheKey, $data, 1);
        }
        return $this->response(false, 'success', $data);
    }

    protected function findProduct($categorySlug, $productSlug)
    {
        if (($model = Product::getBySlug($categorySlug, $productSlug)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
