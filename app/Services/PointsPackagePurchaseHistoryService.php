<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Constant;
use App\Enums\DBConstant;
use App\Repositories\PointsPackagePurchaseHistory\PointsPackagePurchaseHistoryRepositoryInterface;
use App\Repositories\PointsPackage\PointsPackageRepositoryInterface;
use App\Repositories\UserPoint\UserPointRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class PointsPackagePurchaseHistoryService
{
    protected $pointsPackagePurchaseHistoryRepository;

    protected $pointsPackageRepository;

    protected $userPointRepository;

    protected $userRepository;

    public function __construct(
        PointsPackagePurchaseHistoryRepositoryInterface $pointsPackagePurchaseHistoryRepository,
        PointsPackageRepositoryInterface $pointsPackageRepository,
        UserPointRepositoryInterface $userPointRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->pointsPackagePurchaseHistoryRepository = $pointsPackagePurchaseHistoryRepository;
        $this->pointsPackageRepository = $pointsPackageRepository;
        $this->userPointRepository = $userPointRepository;
        $this->userRepository = $userRepository;
    }

    public function getPointPurchaseHistory($userIdLogin, $params)
    {
        $page = $params['page'] ?? Constant::DEFAULT_PAGE;
        $keyword = $params['keyword'] ?? '';
        $pointsPurchaseHistory = $this->pointsPackagePurchaseHistoryRepository->getPointPurchaseHistory($userIdLogin, $page, $keyword);

        $data = [
            'page' => $page,
            'total_page' => $pointsPurchaseHistory->lastPage(),
            'pointsPurchaseHistory' => $pointsPurchaseHistory->items()
        ];

        return $data;
    }

    public function purchasePoints($params)
    {
        DB::beginTransaction();

        try {
            $purchaseHistory = $this->pointsPackagePurchaseHistoryRepository->getByTransId($params['google_trans_id'], $params['apple_trans_id']);

            if ($purchaseHistory) return false;

            $pointPackage = $this->pointsPackageRepository->getByProductId($params['google_product_id'], $params['apple_product_id']);

            if (!$pointPackage) return false;

            $currentPoint = $this->userPointRepository->checkCurrentPoint($params['user_id']);

            if (!$currentPoint) {
                $currentP = 0;
            } else {
                $currentP = $currentPoint->points_balance;
            }

            $userPoint = $this->userPointRepository->create([
                'user_id' => $params['user_id'],
                'type' => DBConstant::TYPE_DEPOSIT,
                'deposit_points' => $pointPackage->points,
                'deposit_reason' => DBConstant::DEPOSIT_REASON_PURCHASE,
                'withdrawal_points' => null,
                'withdrawal_reason' => null,
                'transacted_at' => now(),
                'points_balance' => $currentP + $pointPackage->points
            ]);
            $this->pointsPackagePurchaseHistoryRepository->create([
                'user_point_id' => $userPoint->user_point_id,
                'points_package_id' => $pointPackage->points_package_id,
                'payment_amount' => $pointPackage->price,
                'purchased_at' => now(),
                'apple_trans_id' => isset($params['apple_receipt']) ? json_decode($params['apple_receipt'], true)['transactionId'] : null,
                'google_trans_id' => isset($params['google_receipt']) ? json_decode($params['google_receipt'], true)['orderId'] : null,
                'apple_receipt' => isset($params['apple_receipt']) ? $params['apple_receipt'] : null,
                'google_receipt' => isset($params['google_receipt']) ? $params['google_receipt'] : null,
            ]);
            $this->userRepository->update($params['user_id'], ['points_balance' => $currentP + $pointPackage->points]);

            DB::commit();

            return [
                'points_package_id' => $pointPackage->points_package_id,
                'name' => $pointPackage->name,
                'price' => $pointPackage->price,
                'points' => $pointPackage->points
            ];
        } catch (Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }
}
