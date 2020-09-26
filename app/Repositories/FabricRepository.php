<?php

namespace App\Repositories;

use App\Models\Fabric;

class FabricRepository
{
    private $model;

    public function __construct(Fabric $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->model->DB()
            ->select(['fabrics.id', 'fabrics.name', 'fabric_types.name as fabric_type', 'brand', 'grade', 'description', 'description_ind'])
            ->join('fabric_types', 'fabric_types.id', '=', 'fabrics.fabric_type_id')
            ->get();
        return $query;
    }
}
