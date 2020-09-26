<?php

namespace App\Repositories;

use App\Models\FeatureOption;

class FeatureOptionRepository
{
    private $model;

    public function __construct(FeatureOption $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->model->DB()
            ->select(['feature_options.id', 'feature_options.name', 'code_name', 'features.name as feature', 'image', 'is_has_child', 'feature_options.description', 'description_ind'])
            ->join('features', 'features.id', '=', 'feature_options.feature_id')
            ->get();
        return $query;
    }
}
