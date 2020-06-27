<?php

namespace App\Http\Controllers;

use App\Fabric;
use App\Http\Resources\Customer\Fabric as FabricResource;
use App\Http\Resources\Customer\Product as ProductResource;
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
        $data = Cache::get($categorySlug . $productSlug);
        if ($data == null) {
            $product = $this->findProduct($categorySlug, $productSlug);
            $fabric = Fabric::where('category_id', $product->category->id)
                ->leftJoin('fabric_types', 'fabric_types.id', '=', 'fabrics.fabric_type_id')
                ->select('fabrics.*')->get();
            $data = [
                "product" => new ProductResource($product),
                "fabrics" => FabricResource::collection($fabric)->addExtraField($product)
            ];
            Cache::put($categorySlug . $productSlug, $data, 1);
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
