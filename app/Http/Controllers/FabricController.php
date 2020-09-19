<?php

namespace App\Http\Controllers;

use App\Models\Fabric;
use Illuminate\Http\Request;

class FabricController extends Controller
{
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
}
