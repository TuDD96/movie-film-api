<?php

namespace App\Repositories\PointsPackage;

use App\Enums\DBConstant;
use App\Models\PointsPackage;
use App\Repositories\EloquentRepository;

class PointsPackageRepository extends EloquentRepository implements PointsPackageRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return PointsPackage::class;
    }

    public function getPointsPackageList()
    {
        $data = $this->model->orderBy('display_order','ASC')->get();

        return $data;
    }

    public function getByProductId($googleProductId, $appleProductId)
    {
        return $this->model->where('apple_product_id', $appleProductId)
                           ->orWhere('google_product_id', $googleProductId)
                           ->first();
    }
}
