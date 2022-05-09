<?php

namespace App\Repositories\Gift;

use App\Repositories\EloquentRepositoryInterface;

interface GiftRepositoryInterface extends EloquentRepositoryInterface
{
    public function getListGift($page, $limit, $userId);

    public function checkGiftExist($giftId);
}
