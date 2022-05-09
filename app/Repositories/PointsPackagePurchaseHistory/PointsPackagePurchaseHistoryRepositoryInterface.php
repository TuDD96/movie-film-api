<?php

namespace App\Repositories\PointsPackagePurchaseHistory;

use App\Repositories\EloquentRepositoryInterface;

interface PointsPackagePurchaseHistoryRepositoryInterface extends EloquentRepositoryInterface
{
    public function getPointPurchaseHistory($userIdLogin, $page, $keyword);

    public function getByTransId($googleTransId, $appleTransId);
}
