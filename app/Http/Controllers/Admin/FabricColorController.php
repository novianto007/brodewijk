<?php

namespace App\Http\Controllers\Admin;

use App\Models\FabricColor;
use Illuminate\Http\Request;
use ZanySoft\Zip\Zip;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Repositories\FabricColorRepository;

class FabricColorController extends Controller
{
    public function getAll(FabricColorRepository $reporsitory)
    {
        return $this->response(false, 'success', $reporsitory->getAll());
    }

    public function upload(Request $request, $id)
    {
        $file = $request->file('file');
        $fabricColor = FabricColor::find($id);
        if (!$fabricColor) {
            return $this->response(true, 'Not Found', null, 404);
        }

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

    public function destroy($id)
    {
        $fabricColor = FabricColor::find($id);
        if ($fabricColor) {
            $fabricColor->delete();
            return $this->response(false, 'success', null, 200);
        }
        return $this->response(true, 'Not Found', null, 404);
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
}
