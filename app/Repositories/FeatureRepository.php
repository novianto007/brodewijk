<?php

namespace App\Repositories;

use App\Models\Feature;

class FeatureRepository
{
    private $model;

    public function __construct(Feature $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->model->DB()
            ->select(['features.id', 'features.name', 'features.name_ind', 'features.type', 'categories.name AS category', 'feature_depend.name as depend', 'features.description'])
            ->join('categories', 'categories.id', '=', 'features.category_id')
            ->leftJoin('features as feature_depend', 'feature_depend.id', '=', 'features.resource_depend')
            ->get();
        return $query;
    }
}
