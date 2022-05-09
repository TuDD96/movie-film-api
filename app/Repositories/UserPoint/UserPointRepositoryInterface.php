<?php

namespace App\Repositories\UserPoint;

use App\Repositories\EloquentRepositoryInterface;

interface UserPointRepositoryInterface extends EloquentRepositoryInterface
{
    public function getByUserId($userId);

    public function checkCurrentPoint($userId);
}
