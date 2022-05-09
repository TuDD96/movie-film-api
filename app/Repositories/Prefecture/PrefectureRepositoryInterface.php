<?php

namespace App\Repositories\Prefecture;

use App\Repositories\EloquentRepositoryInterface;

interface PrefectureRepositoryInterface extends EloquentRepositoryInterface
{
    public function getList();
}
