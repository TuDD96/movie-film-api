<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Constant;
use App\Repositories\Gift\GiftRepositoryInterface;

class GiftService
{
    protected $giftRepository;

    public function __construct(GiftRepositoryInterface $giftRepository)
    {
        $this->giftRepository = $giftRepository;
    }

    public function getListGift($params)
    {
        $page = $params['page'] ?? Constant::DEFAULT_PAGE;
        $limit = $params['perpage'] ?? Constant::DEFAULT_LIMIT;
        $gifts = $this->giftRepository->getListGift($page, $limit, $params['user_id']);
        
        $data = [
            'page' => $page,
            'total_page' => $gifts->lastPage(),
            'gifts' => $gifts->items()
        ];

        return $data;
    }
}
