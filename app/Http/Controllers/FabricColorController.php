<?php

namespace App\Http\Controllers;

use App\Models\FabricColor;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use ZanySoft\Zip\Zip;
use Illuminate\Support\Str;

class FabricColorController extends Controller
{
    public function upload(Request $request, $id)
    {
        $file = $request->file('file');
        $fabricColor = $this->findModel($id);
        if ($fabricColor->path) {
            array_map('unlink', glob('public/' . storage_path($fabricColor->path) . "/*.*"));
        } else {
            $fabricColor->path = $this->generatePath($fabricColor);
            $fabricColor->save();
        }

        if (!file_exists(storage_path('public/' . $fabricColor->path))) {
            mkdir(storage_path('public/' . $fabricColor->path), 0777, true);
        }

        $zip = Zip::open($file->path());
        $zip->extract(storage_path('public/' . $fabricColor->path));
        return $this->response(false, 'success', null);
    }

    public function store(Request $request)
    {
        $fabricColorInput = $request->all();
        $this->customValidate($request, $fabricColorInput, [
            'fabric_id' => 'required|integer|exists:fabrics,id',
            'name' => 'required|string',
            'image' => 'required|string',
            'code' => 'nullable|string',
        ]);

        $fabricColor = FabricColor::create($fabricColorInput);

        return $this->response(false, 'success', $fabricColor);
    }

    protected function generatePath($fabricColor)
    {
        $fabric = $fabricColor->fabric;
        $categoryName = Str::slug($fabric->fabricType->category->name);
        $type = Str::slug($fabric->fabricType->name);
        $brand = Str::slug($fabric->brand);
        $color = Str::slug($fabricColor->name);
        return sprintf("images/%s/%s/%s/%s", $categoryName, $type, $brand, $color);
    }

    protected function findModel($id)
    {
        if (($model = FabricColor::find($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
