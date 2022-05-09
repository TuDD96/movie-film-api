<?php

namespace App\Repositories\UserPoint;

use App\Models\UserPoint;
use App\Repositories\EloquentRepository;

class UserPointRepository extends EloquentRepository implements UserPointRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return UserPoint::class;
    }

    public function getByUserId($userId)
    {
        return $this->model->where('user_id', $userId)
                           ->orderBy('user_point_id', 'DESC')
                           ->first();
    }

    public function checkCurrentPoint($userId)
    {
        $checkCurrentPoint = $this->model->select('user_points.*')
                                         ->where('user_id', $userId)
                                         ->orderBy('user_point_id', 'DESC')
                                         ->first();

        return $checkCurrentPoint;
    }
}
