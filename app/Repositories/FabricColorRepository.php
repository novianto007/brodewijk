<?php

namespace App\Repositories;

use App\Models\FabricColor;

class FabricColorRepository
{
    private $model;

    public function __construct(FabricColor $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->model->DB()
            ->select(['fabric_colors.id', 'fabric_colors.name', 'fabrics.name as fabric_name', 'image', 'code'])
            ->join('fabrics', 'fabrics.id', '=', 'fabric_colors.fabric_id')
            ->get();
        return $query;
    }
}
