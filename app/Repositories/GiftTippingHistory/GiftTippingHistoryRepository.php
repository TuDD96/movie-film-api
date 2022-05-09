<?php

namespace App\Repositories\GiftTippingHistory;

use App\Models\GiftTippingHistory;
use App\Repositories\EloquentRepository;

class GiftTippingHistoryRepository extends EloquentRepository implements GiftTippingHistoryRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return GiftTippingHistory::class;
    }
}
