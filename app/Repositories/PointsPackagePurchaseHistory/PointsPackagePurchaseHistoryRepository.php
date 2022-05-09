<?php

namespace App\Repositories\PointsPackagePurchaseHistory;

use App\Enums\Constant;
use App\Enums\DBConstant;
use App\Models\PointsPackagePurchaseHistory;
use App\Repositories\EloquentRepository;

class PointsPackagePurchaseHistoryRepository extends EloquentRepository implements PointsPackagePurchaseHistoryRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return PointsPackagePurchaseHistory::class;
    }

    public function getPointPurchaseHistory($userIdLogin, $page, $keyword)
    {
        $query = $this->model->select('points_package_purchase_histories.id', 'points_package_purchase_histories.payment_amount', 'points_package_purchase_histories.purchased_at', 'pp.name', 'pp.points')
                                            ->join('user_points as up', 'points_package_purchase_histories.user_point_id', 'up.user_point_id')
                                            ->join('points_packages as pp', 'points_package_purchase_histories.points_package_id', 'pp.points_package_id')
                                            ->where('up.user_id', $userIdLogin)
                                            ->where('up.type', DBConstant::TYPE_DEPOSIT);

        if ($keyword) {
            $query = $query->whereDate('points_package_purchase_histories.purchased_at', $keyword);
        }

        $data = $query->orderBy('points_package_purchase_histories.purchased_at', 'DESC')->paginate(Constant::DEFAULT_LIMIT);

        return $data;
    }

    public function getByTransId($googleTransId, $appleTransId)
    {
        return $this->model->where('apple_trans_id', $appleTransId)
                           ->where('google_trans_id', $googleTransId)
                           ->first();
    }
}
