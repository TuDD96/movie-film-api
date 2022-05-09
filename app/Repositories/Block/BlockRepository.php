<?php

namespace App\Repositories\Block;

use App\Models\Block;
use App\Repositories\EloquentRepository;

class BlockRepository extends EloquentRepository implements BlockRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Block::class;
    }

    public function getByUserId($userId)
    {
        return $this->model->where('from_user_id', $userId)->pluck('to_user_id')->toArray();
    }

    public function getFrotmAndToUserId($fromUserId, $toUserId)
    {
        return $this->model->where('from_user_id', $fromUserId)->where('to_user_id', $toUserId)->first();
    }
}
