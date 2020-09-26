<?php

namespace App\Repositories;

use App\Models\FabricType;

class FabricTypeRepository
{
    private $model;

    public function __construct(FabricType $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->model->DB()
            ->select(['fabric_types.id', 'fabric_types.name', 'base_price', 'categories.name AS category'])
            ->join('categories', 'categories.id', '=', 'fabric_types.category_id')
            ->get();
        return $query;
    }
}
