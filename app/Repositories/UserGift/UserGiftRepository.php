<?php

namespace App\Repositories\UserGift;

use App\Enums\DBConstant;
use App\Models\UserGift;
use App\Repositories\EloquentRepository;

class UserGiftRepository extends EloquentRepository implements UserGiftRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return UserGift::class;
    }

    public function getList($id, $page, $limit)
    {
        return $this->model->select(
            'user_gifts.user_gift_id',
            'user_gifts.user_id',
            'user_gifts.gift_id',
            'user_gifts.status',
            'user_gifts.created_at',
            'g.gift_id',
            'g.name',
            'g.points_spent',
            'g.image_url')
            ->join('gifts as g', 'g.gift_id', 'user_gifts.gift_id')
            ->where('user_gifts.user_id', $id)
            ->where('user_gifts.status', DBConstant::STATUS_UNUSED)
            ->orderBy('user_gifts.created_at', 'DESC')
            ->paginate($limit);
    }

    public function getByUserId($userId, $userGiftId)
    {
        return $this->model->select(
            'user_gifts.*',
            'g.points_spent')
            ->join('gifts as g', 'g.gift_id', 'user_gifts.gift_id')
            ->where('user_gifts.user_gift_id', $userGiftId)
            ->where('user_gifts.user_id', $userId)
            ->where('user_gifts.status', DBConstant::STATUS_UNUSED)
            ->first();
    }
}
