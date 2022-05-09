<?php

namespace App\Repositories\Prefecture;

use App\Enums\DBConstant;
use App\Models\Prefecture;
use App\Repositories\EloquentRepository;

class PrefectureRepository extends EloquentRepository implements PrefectureRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Prefecture::class;
    }

    public function getList()
    {
        return $this->model->get();
    }
}
