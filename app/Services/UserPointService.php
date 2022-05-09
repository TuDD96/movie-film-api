<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\DBConstant;
use App\Repositories\Gift\GiftRepositoryInterface;
use App\Repositories\GiftPurchaseHistory\GiftPurchaseHistoryRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserGift\UserGiftRepositoryInterface;
use App\Repositories\UserPoint\UserPointRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;

class UserPointService
{
    protected $userPointRepository;
    protected $giftRepository;
    protected $userGiftRepository;
    protected $giftPurchaseHistoriesRepository;
    protected $userRepository;

    public function __construct(
        UserPointRepositoryInterface $userPointRepository,
        GiftRepositoryInterface $giftRepository,
        UserGiftRepositoryInterface $userGiftRepository,
        GiftPurchaseHistoryRepositoryInterface $giftPurchaseHistoriesRepository,
        UserRepositoryInterface $userRepository
    )
    {
        $this->userPointRepository = $userPointRepository;
        $this->giftRepository = $giftRepository;
        $this->userGiftRepository = $userGiftRepository;
        $this->giftPurchaseHistoriesRepository = $giftPurchaseHistoriesRepository;
        $this->userRepository = $userRepository;
    }

    public function purchaseGift($userId, $giftId, $amount)
    {
        DB::beginTransaction();

        try {
            $gift = $this->giftRepository->checkGiftExist($giftId);
            $currentUserPoint = $this->userPointRepository->checkCurrentPoint($userId);

            if (!$gift) {
                return [
                    'success' => false,
                    'msg' => trans('errors.MSG_4041')
                ];
            }

            if (!$currentUserPoint) {
                return [
                    'success' => false,
                    'msg' => trans('message.not_enough_point')
                ];
            }

            if ($currentUserPoint['points_balance'] - ($gift['points_spent'] * $amount) < 0) {
                return [
                    'success' => false,
                    'msg' => trans('message.not_enough_point')
                ];
            }

            for ($i = 1; $i <= $amount; $i++) {
                $newUserPoint = $this->userPointRepository->checkCurrentPoint($userId);
                $userPoint = $this->userPointRepository->create([
                    'user_id' => $userId,
                    'type' => DBConstant::TYPE_WITHDRAWAL,
                    'deposit_points' => null,
                    'deposit_reason' => null,
                    'withdrawal_points' => $gift['points_spent'],
                    'withdrawal_reason' => DBConstant::WITHDRAWAL_REASON_EXCHANGE_FOR_A_GIFT,
                    'points_balance' => $newUserPoint['points_balance'] - $gift['points_spent'],
                    'transacted_at' => now(),
                ]);

                $userGift = $this->userGiftRepository->create([
                    'user_id' => $userId,
                    'gift_id' => $giftId,
                    'status' => DBConstant::STATUS_UNUSED,
                    'used_at' => null,
                ]);

                $this->giftPurchaseHistoriesRepository->create([
                    'user_gift_id' => $userGift['user_gift_id'],
                    'user_point_id' => $userPoint['user_point_id'],
                    'points_spent' => $gift['points_spent'],
                    'purchased_at' => now(),
                ]);

                $this->userRepository->update($userId, ['points_balance' => $newUserPoint['points_balance'] - $gift['points_spent']]);
            }
            DB::commit();

            return [
                'success' => true,
                'data' => [
                    'gift_id' => $giftId,
                    'name' => $gift['name'],
                    'amount' => $amount,
                    'points_spent' => $gift['points_spent']
                ]
            ];

        } catch (Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }
}
