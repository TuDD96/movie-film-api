<?php

namespace App\Repositories\GiftPurchaseHistory;

use App\Models\GiftPurchaseHistory;
use App\Repositories\EloquentRepository;

class GiftPurchaseHistoryRepository extends EloquentRepository implements GiftPurchaseHistoryRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return GiftPurchaseHistory::class;
    }
}
