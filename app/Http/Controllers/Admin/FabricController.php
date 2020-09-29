<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fabric;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\FabricRepository;

class FabricController extends Controller
{
    public function getAll(FabricRepository $reporsitory)
    {
        return $this->response(false, 'success', $reporsitory->getAll());
    }

    public function store(Request $request)
    {
        $fabricInput = $request->all();
        $this->customValidate($request, $fabricInput, [
            'fabric_type_id' => 'required|integer|exists:fabric_types,id',
            'name' => 'required|string',
            'brand' => 'required|string',
            'grade' => 'required|string',
            'description' => 'string',
            'description_ind' => 'string'
        ]);

        $fabric = Fabric::create($fabricInput);

        return $this->response(false, 'success', $fabric);
    }

    public function destroy($id)
    {
        $fabric = Fabric::find($id);
        if ($fabric) {
            if ($fabric->fabricColors()->count()) {
                return $this->response(true, 'Fabric is used by another resource', null, 400);
            }
            $fabric->delete();
            return $this->response(false, 'success', null, 200);
        }
        return $this->response(true, 'Not Found', null, 404);
    }
}
