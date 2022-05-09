<?php

namespace App\Repositories\DeviceToken;

use App\Repositories\BaseRepositoryInterface;
use App\Repositories\EloquentRepositoryInterface;

interface DeviceTokenRepositoryInterface extends EloquentRepositoryInterface
{
    public function removeToken($request);

    public function saveToken($userId, $request);
}
