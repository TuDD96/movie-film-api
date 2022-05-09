<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Constant;
use App\Enums\DBConstant;
use App\Repositories\Gift\GiftRepository;
use App\Repositories\UserGift\UserGiftRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\GiftTippingHistory\GiftTippingHistoryRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class UserGiftService
{
    protected $userGiftRepository;
    protected $userRepository;
    protected $giftTippingHistoryRepository;
    protected $giftRepository;

    public function __construct(
        UserGiftRepositoryInterface $userGiftRepository,
        UserRepositoryInterface $userRepository,
        GiftTippingHistoryRepositoryInterface $giftTippingHistoryRepository,
        GiftRepository $giftRepository
    ) {
        $this->userGiftRepository = $userGiftRepository;
        $this->userRepository = $userRepository;
        $this->giftTippingHistoryRepository = $giftTippingHistoryRepository;
        $this->giftRepository = $giftRepository;
    }

    public function getUserGiftList($params, $id)
    {
        $page = $params['page'] ?? Constant::DEFAULT_PAGE;
        $limit = $params['perpage'] ?? Constant::DEFAULT_LIMIT;
        $userGifts = $this->userGiftRepository->getList($id, $page, $limit);

        $data = [
            'page' => $page,
            'total_page' => $userGifts->lastPage(),
            'user_gifts' => $userGifts->items()
        ];

        return $data;
    }

    public function tipping($params)
    {
        DB::beginTransaction();

        try {
            $toUser = $this->userRepository->find($params['to_user_id']);

            if (!$toUser) return false;

            $userGift = $this->userGiftRepository->getByUserId($params['user_id'], $params['user_gift_id']);

            if (!$userGift) return false;

            $updatedUserGift = $this->userGiftRepository->update($params['user_gift_id'], [
                'status' => DBConstant::STATUS_USED,
                'used_at' => now()
            ]);
            $this->giftTippingHistoryRepository->create([
                'user_gift_id' => $params['user_gift_id'],
                'to_user_id' => $params['to_user_id'],
                'points_equivalent' => $userGift->points_spent,
                'tipped_at' => now(),
            ]);
            $this->userRepository->update($params['to_user_id'], ['points_received' => $toUser->points_received + ($userGift->points_spent / 2)]);

            DB::commit();

            return $updatedUserGift;
        } catch (Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    public function checkGiftExist($giftId)
    {
        return $this->giftRepository->checkGiftExist($giftId);
    }
}

