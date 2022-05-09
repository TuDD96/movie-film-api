<?php

namespace App\Repositories\Block;

use App\Repositories\BaseRepositoryInterface;
use App\Repositories\EloquentRepositoryInterface;

interface BlockRepositoryInterface extends EloquentRepositoryInterface
{
    public function getByUserId($userId);

    public function getFrotmAndToUserId($fromUserId, $toUserId);
}
