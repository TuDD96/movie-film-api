<?php

namespace App\Repositories\Gift;

use App\Enums\DBConstant;
use App\Models\Gift;
use App\Repositories\EloquentRepository;

class GiftRepository extends EloquentRepository implements GiftRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Gift::class;
    }

    public function getListGift($page, $limit, $userId)
    {
        return $this->model->with(['userGifts' => function($query) use ($userId) {
                $query->where('user_id', $userId);
                $query->where('status', DBConstant::STATUS_UNUSED);
            }])
            ->paginate($limit);
    }

    public function checkGiftExist($giftId)
    {
        return $this->model->where('gift_id', $giftId)->first();
    }
}
