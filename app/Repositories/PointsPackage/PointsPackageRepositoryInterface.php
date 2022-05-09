<?php

namespace App\Repositories\PointsPackage;

use App\Repositories\EloquentRepositoryInterface;

interface PointsPackageRepositoryInterface extends EloquentRepositoryInterface
{
    public function getPointsPackageList();

    public function getByProductId($googleProductId, $appleProductId);
}
